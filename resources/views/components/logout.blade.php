<form method="POST" action="{{ route('auth-v1.logout') }}" class="hidden" aria-hidden="true" id="auth-v1-form">
    @csrf
</form>
<button form="auth-v1-form" type="submit" class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium'>Logout</button>

