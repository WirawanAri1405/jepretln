function togglePassword(id, iconId) {
  const input = document.getElementById(id);
  const icon = document.getElementById(iconId);

  if (input.type === "password") {
    input.type = "text";
    icon.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.519-4.042m2.456-1.923A9.958 9.958 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.993 9.993 0 01-4.243 5.093M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
  } else {
    input.type = "password";
    icon.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />`;
  }
}
