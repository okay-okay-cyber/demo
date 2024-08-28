@extends('layouts.app')
@section('content')

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color:red">{{$error}}</li>        
    @endforeach
</ul>
@endif

<body>
    <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">User Form</h1>
        <form>
            <div class="mb-3">
                <label for="userId" class="form-label">ID</label>
                <input type="text" name="id"class="form-control" id="userId" placeholder="Enter User Id">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="role" placeholder="Enter Role">
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Name</label>
                <input type="text" name="name"class="form-control" id="userName" placeholder="Enter user name" value="{{old('name',$user->name)}}">
            </div>
            <div class="mb-3">
                <label for="userPhoto" class="form-label">Photo</label>
                <input class="form-control"  name="photo" type="file" id="userPhoto">
                @if(file_exists(storage_path().'/app/public/'. $user->photo))
                <img src="{{asset('storage/'.$user->photo)}}"width="50" height="50"/>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
            </div>
            <div class="mb-3">
                <label for="phoneno" class="form-label">Phone Number</label>
                <input type="text" name="phoneno" class="form-control" id="phoneno" placeholder="Enter Phone Number">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" class="form-control" id="age" placeholder="Enter Age">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height (cm)</label>
                <input type="number" name="height" class="form-control" id="height" placeholder="Enter Height">
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" name="weight" class="form-control" id="weight" placeholder="Enter Weight">
            </div>
           
            <div class="mb-3">
                <label for="userSubscription" class="form-label">Subscription Renewable Date</label>
                <input type="date" name="subscription_renewable_date" class="form-control" id="subscription_renewable_date">
                <select class="form-select" name="subscription_id" id="userSubscription">
                    <option disabled>Choose a subscription renewable date</option>
                    @foreach($subscriptions as $subscription)
                    <option value="{{$subscription->id}}">{{$subscription->renewable_date}}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Action</label>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2" value="update">update</button>
                   
                </div>
            </div>
        </form>
    </div>
    </body>
@endsection  