@extends('layouts.app')

@section('content')
    <main>

        <section class="admin bg-F5F5F5 h-vh">
            <div class="d-flex flex-wrap h-100">

                <div class="admin-wrapper h-100 overflow-auto">
                    <div class="container-fluid h-100">
                        <div class="ps-5 h-100 d-flex flex-column">
                            <a href="{{ route('user-manage.edit', $user->id) }}"
                                class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black fw-normal ms-3">
                                Back to user
                            </a>


                            <form id="permissionForm" action="{{ route('permissions.update', $user->id) }}" method="GET">
                                @csrf
                                @method('PUT')


                                <div class="col-11 user-permission dpb-65">
                                    <div
                                        class="user-permission-edit-post radius5 d-flex align-items-center px-3 dmb-20 tk-basic-sans font16 leading24 space-0_16 text-black bg-white dpt-20 dpb-20">

                                        <h4>Assigned Role: {{ $user->roles->pluck('name')->join(', ') }}</h4>

                                    </div>

                                    @foreach ($permissions as $permission)
                                        <div class="pe-5 dmb-35">
                                            <div
                                                class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-15">
                                                Select access</div>
                                            <div class="row">
                                                <div class="col-4 dmb-15">
                                                    <div
                                                        class="checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading29 space-0_16 text-black">


                                                        <input type="checkbox" id="permission-{{ $permission->id }}"
                                                            class="opacity-0 position-absolute top-0 start-0 permission-checkbox"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            {{ $permission->is_checked == 0 ? 'checked' : '' }}
                                                            onchange="updatePermission({{ $permission->id }}, this)">

                                                        <span
                                                            class="check-box black-checkbox radius5 position-relative me-3"></span>
                                                        {{ $permission->name }}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </form>

                            <div class="d-flex justify-content-between align-items-center dmb-60">

                                <form id="delete-form" action="{{ route('permissions.destroy', $permission->id) }}"
                                    method="GET">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" id="delete-button"
                                        class="btnB DEDEDE-bg-btn radius7 border-0 transition tk-basic-sans font16 leading19 space-0_16 text-808080">
                                        Delete Permission
                                        <img src="{{ asset('images/delet.svg') }}" class="delete-icon ms-2"
                                            alt="delete icon">
                                    </button>

                                </form>

                                <button type="submit" id="savePermissions"
                                    class="btnB DEDEDE-bg-btn radius7 border-0 transition tk-basic-sans font16 leading19 space-0_16 text-808080">Save
                                    Changes</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

    </main>
@endsection

@push('page-specific-scripts')
    <script>
        console.log('hey');

        function updatePermission(id, checkbox) {

            console.log('start');

            let isChecked = checkbox.checked ? 0 : 1; // 0 means checked, 1 means unchecked

            console.log(isChecked);

            $.ajax({
                url: '/permissions/' + id,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    is_checked: isChecked
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Permission updated successfully');

                    } else {
                        console.log('Error updating permission');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error: ' + error);
                }
            });
        }

    </script>
@endpush
