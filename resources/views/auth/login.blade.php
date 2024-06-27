<x-app-layout>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Aplikasi Task Manager.</h3>
                    <p>Silahkan login terlebih dahulu.</p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="page-links">
                            <a href="{{route('login')}}" class="active">Login</a><a
                                href="{{route('register')}}">Register</a>
                        </div>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <input class="form-control @error('email') in-valid @enderror" type="email" name="email"
                                value="{{old('email')}}" placeholder="E-mail Address">
                            @error('email')
                            <div class="invalid">
                                {{ $message }}
                            </div>
                            @enderror
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>