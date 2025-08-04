<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class SecurityAuditCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:audit {--fix : Fix security issues automatically}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit system for security issues';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🔒 Starting Security Audit...');

        $issues = [];

        // Check for suspicious user accounts
        $this->checkSuspiciousUsers($issues);

        // Check for users without proper permissions
        $this->checkUserRole($issues);

        // Display results
        $this->displayResults($issues);

        // // Fix issues if requested
        // if ($this->option('fix')) {
        //     $this->fixIssues($issues);
        // }

        return 0;
    }

    private function checkSuspiciousUsers(&$issues)
    {
        $this->info('Checking for suspicious users...');

        // Check for owner user who created a booking or offer
        $suspiciousUsers = User::doesntHave('invitees')->whereHas('roles', function($q){
            $q->where('name', User::ROLE_CLIENT);
        })->get();

        foreach ($suspiciousUsers as $user) {
            $issues[] = [
                'type' => 'suspicious_user',
                'severity' => 'mediam',
                'message' => "User {$user->email} does not have any invites.",
                'user_id' => $user->id
            ];
        }
    }

    private function checkUserRole(&$issues)
    {
        $this->info('Checking user role...');

        $suspiciousUsers = User::doesntHave('roles')->get();

        foreach ($suspiciousUsers as $user) {
            $issues[] = [
                'type' => 'no_role',
                'severity' => 'medium',
                'message' => "User {$user->email} has no role assigned",
                'user_id' => $user->id
            ];
        }
    }

    private function displayResults($issues)
    {
        if (empty($issues)) {
            $this->info('✅ No security issues found!');
            return;
        }

        $this->warn('⚠️  Security issues found:');

        foreach ($issues as $issue) {
            $severity = strtoupper($issue['severity']);
            $message = $issue['message'];

            switch ($issue['severity']) {
                case 'high':
                    $this->error("[{$severity}] {$message}");
                    break;
                case 'medium':
                    $this->warn("[{$severity}] {$message}");
                    break;
                default:
                    $this->info("[{$severity}] {$message}");
            }
        }

        $this->info("\nTotal issues found: " . count($issues));
    }

    private function fixIssues($issues)
    {
        $this->info('🔧 Fixing security issues...');

        foreach ($issues as $issue) {
            switch ($issue['type']) {
                case 'no_role':
                    break;
            }
        }

        $this->info('✅ Security fixes applied!');
    }
}
