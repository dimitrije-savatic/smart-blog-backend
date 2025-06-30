<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Message</title>
</head>
<div class="body">
<h1>New Message from Smart Blog App</h1>
<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $data['message'] }}</p>
</div>
</html>
