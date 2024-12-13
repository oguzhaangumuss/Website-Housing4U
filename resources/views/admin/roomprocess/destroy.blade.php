<form action="{{ route('admin.roomprocess.deleteroom', $room->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>