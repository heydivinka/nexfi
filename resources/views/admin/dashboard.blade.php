<h1>Dashboard Admin 🔥</h1>
<p>Kamu login sebagai admin</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" style="
        margin-top:20px;
        padding:10px 16px;
        background:#ef4444;
        color:white;
        border:none;
        border-radius:6px;
        cursor:pointer;
    ">
        Logout
    </button>
</form>