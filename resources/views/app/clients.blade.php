@extends('layouts.app')

@section('content')
    @guest
        <script>
            window.location = "/login";
        </script>
    @endguest
    @auth
        <h2 class="mb-4">Clients</h2>

        <form action="{{ route('FindClient') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <a title="Add new client" class="add-r-button btn btn-success rounded-0" data-bs-toggle="modal"
                    data-bs-target="#AddNewClientModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                <input type="text" name="keywordToFind" class="form-control rounded-0"
                    placeholder="Type First Name|Last Name|Phone Number|City.." aria-label="Find"
                    aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary rounded-0 finder_button" type="submit" id="button-addon2"><i
                        class="fa fa-search"></i></button>
            </div>
        </form>
        <!--Start clients table-->
        @if (!$clients->isEmpty())
            <table class="table table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col">Create Date</th>
                        <th scope="col">FullName</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">City</th>
                        <th scope="col">Total amount</th>
                        <th scope="col">Create By user</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->created_at }}</th>
                            <td>{{ $client->firstname . ' ' . $client->lastname }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->totalAmount }}</td>
                            <td>{{ $client->user->name . ' ' . $client->user->firstname }}</td>
                            <td>
                                @for ($i = 0; $i < $client->rating; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </td>
                            <td><a href="#" class="btn btn-success btn-sm  rounded-0"
                                    onclick="EditClient({{ $client->id }},'{{ $client->firstname }}','{{ $client->lastname }}','{{ $client->phone }}','{{ $client->city }}',{{ $client->rating }})"
                                    data-bs-toggle="modal" data-bs-target="#AddEditClientModal">Edit</a></td>
                            <td>
                                <form action="{{ Route('client.destroy', $client->id) }}" method="POST"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                        onclick="return confirm('Sure you want to remove this task?','Warning!')"
                                        class="btn btn-danger btn-sm rounded-0 text-light">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach







                </tbody>
            </table>
        @else
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> No
                <strong>clients</strong> to show</h5>
        @endif
        <!--End clients table-->

        <!--Start New Client Modal-->
        <div class="modal fade" id="AddNewClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AddNewClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('client.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="AddNewClientModalLabel">Add New Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="firstname" placeholder="First Name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="lastname" placeholder="last Name">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control rounded-0" name="phone" placeholder="Phone Number"
                                    required>
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="city" placeholder="City" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectaddclient" name="rating"
                                        aria-label="Floating label select example">
                                        <option selected>Select Rating</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="floatingSelectaddclient">Five stars for new client</label>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm text-light rounded-0" data-bs-dismiss="modal">Cancel</a>
                            <button type="submet" class="btn btn-success btn-sm rounded-0">Add Client</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End New Client Modal-->

        <!--Start Edit Client Modal-->
        <div class="modal fade" id="AddEditClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="EditClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('EditTask') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="idEdit" value="">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="EditClientModalLabel">Edit Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="firstname" id="firstname"
                                    placeholder="First Name" required value="amine">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="lastname" id="lastname"
                                    placeholder="last Name" required value="aqebli">
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control rounded-0" name="phone" id="phone"
                                    placeholder="Phone Number" required value="0687591067">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="city" id="city" placeholder="City"
                                    required value="marrakech">
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="rating" id="rating"
                                        aria-label="Floating label select example">
                                        <option>Select Rating</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <label for="rating">Select between 1 to 5 stars</label>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm text-light rounded-0" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Edit Client</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Edit Client Modal-->



        <!--Start Remove client Modal-->
        <div class="modal fade" id="removeClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="removeClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="">

                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="removeClientModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sure you want to remove this client!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded-0"
                                data-bs-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger btn-sm rounded-0">Remove client</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove client Modal-->



    @endauth
@endsection
