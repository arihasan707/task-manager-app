<x-app-layout>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Aplikasi Task Manager.</h3>
                    <p>Silahkan register terlebih dahulu.</p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="page-links">
                            <a href="{{route('login')}}">Login</a><a href="{{route('register')}}" class="active">Register</a>
                        </div>
                        <form action="{{route('register')}}" method="post">
                            @csrf
                            <input class="form-control @error('name') in-valid @enderror" value="{{old('name')}}" type="text" name="name" placeholder="Full Name">
                            @error('name')
                            <div class="invalid">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="form-control @error('email') in-valid @enderror" value="{{old('email')}}" type="email" name="email" placeholder="E-mail">
                            @error('email')
                            <div class="invalid">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="form-control  @error('password') in-valid @enderror" type="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="form-control" type="password" name="password confirmation" placeholder="Konfirmasi Password">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>