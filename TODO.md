# TODO: Fix Blade rendering issue in Leaderboard

- [ ] Refactor `resources/views/public/leaderboard.blade.php` to extend `resources/views/layouts/public.blade.php` and render inside `@section('content')` (preserve existing UI/CSS).
- [ ] Verify `app/Http/Controllers/LeaderboardController.php` passes the expected variables (`$ranked`, `$totalUsers`) with correct types.
- [ ] Ensure no hardcoded/dummy values were added.
- [ ] Run thorough testing:
  - [ ] Open `/leaderboard` and verify all dynamic values render (counts, top podium users, full list).
  - [ ] Click at least one user from the leaderboard and ensure the profile loads correctly.
  - [ ] Toggle “Tampilkan di Leaderboard” on profile (opt-in/out) and confirm leaderboard changes.
  - [ ] Scroll through the full leaderboard list to ensure loops/conditionals render correctly.
