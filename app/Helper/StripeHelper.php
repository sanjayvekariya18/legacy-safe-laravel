<?php

namespace App\Helper;

use Exception;

class StripeHelper
{

    public static function getOneCustomer($customer_id)
    {

        $stripe = new \Stripe\StripeClient(ENV('STRIPE_SK'));
        try {
            $allCustomers = $stripe->customers->retrieve($customer_id);
            return [
                'status' => true,
                'error' => null,
                'data' => $allCustomers,
            ];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public static function createCustomer($data, $token)
    {
        $stripe = new \Stripe\StripeClient(ENV('STRIPE_SK'));
        try {
            $created = $stripe->customers->create($data);
            return [
                'status' => true,
                'error' => null,
                'data' => $created,
            ];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public static function createSubscription($customer_id, $pirce_plan_id, $couponCode = null)
    {
        $stripe = new \Stripe\StripeClient(ENV('STRIPE_SK'));
        try {
            $created = $stripe->subscriptions->create([
                'customer' => $customer_id,
                'items' => [
                    ['price' => $pirce_plan_id],
                ],
                'coupon' => $couponCode,
            ]);

            return [
                'status' => true,
                'error' => null,
                'data' => $created,
            ];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        }
    }


    public static function retrieveSubscription($sub_id){
        $stripe = new \Stripe\StripeClient( ENV('STRIPE_SK') );
        try {
            $retrieve = $stripe->subscriptions->retrieve($sub_id);
            return [
                'status' => true,
                'error' => null,
                'data' => $retrieve
            ];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }catch (\Stripe\Exception\AuthenticationException $e) {
            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        } catch(Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
