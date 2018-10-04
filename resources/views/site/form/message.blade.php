<div class="message-form">
	
	@if($errors->any())
	<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	{!! Form::open(['route' => 'page.contactMessage', 'method' => 'POST']) !!}
		<div class="row">
			<div class="name col-md-4">
				<input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
			</div>
			<div class="email col-md-4">
				<input type="text" name="email" id="email" placeholder="example@gmail.com" value="{{ old('email') }}">
			</div>
			<div class="subject col-md-4">
				<input type="text" name="subject" id="subject" placeholder="Subject" value="{{ old('subject') }}">
			</div>
		</div>
		<div class="row">        
			<div class="text col-md-12">
				{!! Form::textarea('message') !!}
			</div>   
		</div>                              
		<div class="send">
			<a href="#"><button type="submit"><i class="fab fa-telegram-plane" style="font-size: 2.5rem;"></i>    Send</button></a>
		</div>
	{!! Form::close() !!}
</div>
