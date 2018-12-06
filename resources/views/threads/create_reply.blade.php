<div class="card bg-dark border-secondary text-white mb-4">
    <div class="card-body">
        <form method="POST" action="/threads/{{ $thread->id }}/replies">
             @csrf

            <div class="form-group">
                <label for="body">Type a reply...</label>
                <textarea class="form-control" id="body" name="body" rows="3" placeholder="Your reply here..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>