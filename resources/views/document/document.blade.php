@extends('layouts.app')

@section('content')
    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="d-flex flex-column h-100 justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
                                    <div class="title d-flex align-items-center">
                                        <div
                                            class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('images/document.svg') }}" alt="document icon">
                                        </div>
                                        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                            Documents
                                        </div>
                                    </div>

                                    <div class="col-5 ps-3">
                                        <div class="position-relative w-100">
                                            <form action="{{ route('document.index') }}" method="GET">
                                                <input type="text" name="search" value="{{ $search }}"
                                                    placeholder="Who are you looking for?.."
                                                    class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">
                                                <div
                                                    class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">

                                                    <button type="submit"
                                                        class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('images/search-icon.svg') }}" alt="search icon">
                                                    </button>


                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <table class="table common-table dmb-5 pe-3">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Owner</th>
                                            <th>Shared with</th>
                                            <th>Last Modified</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="tables pe-3">
                                    <table class="table common-table document-table mb-0">
                                        <tbody>
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $document->name }}</td>
                                                    <td>{{ $document->User ? $document->User->name : 'No User' }}</td>
                                                    <td>{{ $document->SharedWithUser->count() }} users</td>
                                                    <td>{{ $document->updated_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <button
                                                                class="border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5"
                                                                onclick="window.location.href='{{ route('document.show', $document->id) }}'">View</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between dmb-30">
                                <div class="pagination d-flex align-items-center">
                                    {{ $documents->links() }}
                                </div>
                                <div>
                                    <a href="{{ route('file.upload') }}"
                                        class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7">
                                        <img src="{{ asset('images/plus-circle.svg') }}" alt="Circle Icon" class="me-2">
                                        Add new file
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
