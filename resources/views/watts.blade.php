<form action="/whatsapp/send-message" method="POST">
    @csrf
    <label for="phone_number">Phone Number:</label>
    <input type="text" name="phone_number" required>
    <label for="message">Message:</label>
    <textarea name="message" required></textarea>
    <button type="submit">Send Message</button>
</form>
