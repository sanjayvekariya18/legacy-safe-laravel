@extends('layouts.app')

@section('content')

<main>

    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <a href="{{ route('user-manage.edit',$user->id) }}"
                            class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black fw-normal ms-3">
                            Back to user
                        </a>


                        <form id="permissionForm" action="{{ route('permissions.update',$user->id) }}" method="GET">
                            @csrf
                            @method('PUT')

                            <div class="col-11 user-permission dpb-65">
                                <div
                                    class="user-permission-edit-post radius5 d-flex align-items-center px-3 dmb-20 tk-basic-sans font16 leading24 space-0_16 text-black bg-white dpt-20 dpb-20">
                                    {{-- <h4> {{ $user->professional_type }}</h4> --}}

                                    <h4>Assigned Role: {{ $user->roles->pluck('name')->join(', ') }}</h4>

                                </div>

                                @foreach ($permissions as $permission)

                                <div class="pe-5 dmb-35">
                                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-15">
                                        Select access</div>
                                    <div class="row">
                                        <div class="col-4 dmb-15">
                                            <div
                                                class="checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading29 space-0_16 text-black">


                                                <input type="checkbox" id="record-checkbox-{{ $permission->id }}"
                                                    class="opacity-0 position-absolute top-0 start-0 permission-checkbox"
                                                    name="permissions[]" value="{{ $permission->id }}" {{
                                                    $user->roles->pluck('permissions')->flatten()->contains('id',$permission->id)?'checked'
                                                : '' }} >


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

                            <form id="delete-form" action="{{ route('permissions.destroy',$permission->id) }}"
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

                            <button type="submit" id="savePermissions" data-id="{{ $permission->id }}"
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

<script type="module">
    {{-- $(document).ready(function(){
        $(document).on('click' , '#update_permissions' , function(e){

            event.preventDefault();
             let id = $(this).data('id');
             console.log("id" : id);

            const checkboxes = document.querySelectorAll('#record-checkbox');
            const selectedIds = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            $.ajax({
                url: '{{ route('permissions.update',$permission->id) }}',
                method: 'PUT',
                success: function(response){
                    alert('Data SucessFully Update');
                },
                error:function(xhr){
                     alert('data Not SuccessFully Update !');
                }

            });

        });
    }); --}}


     $(document).ready(function () {
        console.log('hey'); 
    
        let addedPermissions = JSON.parse(localStorage.getItem('addedPermissions')) || [];
        let removedPermissions = JSON.parse(localStorage.getItem('removedPermissions')) || [];
        
        $('.permission-checkbox').each(function () {
            const permissionId = $(this).val();
            if (addedPermissions.includes(permissionId)) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
              $('.permission-checkbox').on('change', function () {
            const permissionId = $(this).val();
    
            if ($(this).is(':checked')) {
                addedPermissions.push(permissionId);
                removedPermissions = removedPermissions.filter(id => id !== permissionId);
            } else {
                removedPermissions.push(permissionId);
                addedPermissions = addedPermissions.filter(id => id !== permissionId);
            }
    
            console.log('Added:', addedPermissions);
            console.log('Removed:', removedPermissions);
    
           
            localStorage.setItem('addedPermissions', JSON.stringify(addedPermissions));
            localStorage.setItem('removedPermissions', JSON.stringify(removedPermissions));
        });
    
        $('#savePermissions').on('click', function () {
            const id = $(this).data('id');
    
            const data = {
                addedPermissions: addedPermissions,
                removedPermissions: removedPermissions,
            };
    
            $.ajax({
                url: `/permissions/${id}`,
                method: "PUT",
                data: data,
                success: function (response) {
                    alert(response.message);
                    localStorage.removeItem('addedPermissions');
                    localStorage.removeItem('removedPermissions');
                    addedPermissions = [];
                    removedPermissions = [];
                },
                error: function (xhr) {
                    alert('Error occurred: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            });
        });
    });
    

   
</script>

@endpush