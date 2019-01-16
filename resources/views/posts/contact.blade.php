@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-mail">
        <div class="col-md-12">
            <h1>Contact Us</h1>

            <hr>

            <form action="{{ route('contact') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Message here..."></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" value="Send Message" class="btn btn-primary">Publish</button>
                </div>

                @include ('layouts.errors')

            </form>

        </div>
    </div>

@endsection