@extends('admin.layouts.master')
@section('content')


    <section>
        <div class="jumbotron features_parallax">
            <h1 class="apartments_title">Features</h1>
        </div>
        @include('admin.parts.messages.success')
        @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg float-right" data-toggle="modal"
                        data-target="#addFeature">
                    add Feature &nbsp; <i class="fas fa-swatchbook"></i>
                </button>
                <h4 class="apartments_table_title"><u>Features Table</u>&nbsp;&nbsp;<i class="fas fa-swatchbook"></i>
                </h4>
            </div>
        </div>
        <table class="data_table table table-hover table-bordered">
            <thead>
            <tr class="bg-dark custom_apartments_table_head  text-center">
                <th>#</th>
                <th>Name</th>
                <th>Icon</th>
                <th>Apartments that have this feature</th>
                <th>Edit Feature</th>
                <th>Delete Feature</th>
            </tr>
            </thead>
            <tbody>
            @php
                $count=1;
            @endphp
            @foreach($features as $feature)
                <tr class="text-center">
                    <td><strong style="font-size: 20px;">{{$count}}</strong></td>
                    <td>{{$feature->name}}</td>
                    <td>
                        @if($feature->icon)
                            <i class="fas {{$feature->icon}} fa-3x el_ic"></i>
                        @else
                            <p>There is no Image available</p>
                        @endif
                    </td>

                    @php
                        $apartments_with_features=\App\ApartmentFeature::where('features_id', $feature->id)->pluck('apartments_id');
                        $apartments=\App\Apartment::whereIn('id', $apartments_with_features)->get();
                    @endphp
                    <td>
                        @if(count($apartments)>0)
                            <ul style="overflow-y: auto; height: 200px;">
                                @foreach($apartments as $apartment)
                                    @php
                                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                                    @endphp
                                    <li>{{$apartment->location}}<br>
                                        @if($apartment_photo)
                                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}"
                                                 class="" style="width:120px !important; height: auto;">
                                        @else
                                            <p>This Apartment has no photo</p>
                                        @endif
                                        <hr>
                                    </li>
                                    @php
                                        $count++;
                                    @endphp

                                @endforeach
                            </ul>
                        @else
                            <p style="    font-family: 'Saira', sans-serif; font-size: 16px; color: darkred; ">
                                There are no apartments with this <br> feature</p>
                        @endif
                    </td>
                    <td><!-- Button trigger modal for edit apartment -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal"
                                data-target="#editFeature-{{$feature->id}}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    <td><a href="/admin/features/delete/{{$feature->id}}" class="btn btn-danger btn-lg"
                           onclick=" return confirm('Are you sure you want to delete this Feature?')"><i
                                    class="fas fa-eraser"></i></a></td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div class="offset-6">
            {{ $features->links() }}
        </div>

    </section>

    @foreach($features as $feature)
        @include('admin.parts.modals.edit.feature')
    @endforeach
    @include('admin.parts.modals.add.feature')

@endsection