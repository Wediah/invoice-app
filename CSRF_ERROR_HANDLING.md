# CSRF 419 Error Handling Guide

## What is a 419 Error?

A **419 error** in Laravel is a **"Page Expired"** error that occurs when there's a **CSRF (Cross-Site Request Forgery) token mismatch**. This is Laravel's built-in security feature to prevent malicious attacks.

## Why Do 419 Errors Happen?

419 errors occur when:

1. **Missing CSRF Token**: Forms don't include `@csrf` directive
2. **Expired CSRF Token**: The token has expired (default: 2 hours)
3. **Invalid CSRF Token**: Token doesn't match what's stored in the session
4. **AJAX Requests Without Token**: JavaScript requests don't include the CSRF token
5. **Session Issues**: Session data is corrupted or cleared
6. **Multiple Tabs**: User has multiple tabs open with different sessions

## Solutions Implemented

### 1. Enhanced Bootstrap Configuration

**File**: `resources/js/bootstrap.js`

```javascript
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// CSRF Token Configuration
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
```

### 2. CSRF Handler Utility

**File**: `resources/js/csrf-handler.js`

This utility provides:
- Automatic CSRF token refresh
- Axios interceptors for handling 419 errors
- User-friendly error messages
- Automatic retry mechanism

### 3. Custom CSRF Middleware

**File**: `app/Http/Middleware/HandleCsrfMismatch.php`

Provides better error handling for both JSON and web requests.

### 4. CSRF Error Display Component

**File**: `resources/views/components/csrf-error.blade.php`

Displays user-friendly error messages when CSRF errors occur.

### 5. CSRF Token Refresh Route

**File**: `routes/web.php`

```php
// CSRF Token refresh route
Route::get('/csrf-token', function () {
    return response()->json([
        'csrf_token' => csrf_token()
    ]);
})->name('csrf.token');
```

## How to Use

### For Regular Forms

Always include the `@csrf` directive:

```blade
<form method="POST" action="{{ route('example.store') }}">
    @csrf
    <!-- form fields -->
</form>
```

### For AJAX Requests

Use axios (automatically configured with CSRF tokens):

```javascript
// Simple POST request
axios.post('/api/endpoint', {
    data: 'value'
}).then(response => {
    console.log(response.data);
}).catch(error => {
    console.error(error);
});

// With custom headers
axios.post('/api/endpoint', data, {
    headers: {
        'X-CSRF-TOKEN': window.csrfHandler.getCurrentToken()
    }
});
```

### For jQuery AJAX (if needed)

```javascript
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
```

## Prevention Tips

### 1. Always Include CSRF Tokens

```blade
<!-- ✅ Correct -->
<form method="POST">
    @csrf
    <!-- form content -->
</form>

<!-- ❌ Incorrect -->
<form method="POST">
    <!-- Missing @csrf -->
</form>
```

### 2. Use Axios for AJAX

```javascript
// ✅ Correct - Automatic CSRF handling
axios.post('/endpoint', data);

// ❌ Incorrect - Manual token management
$.ajax({
    url: '/endpoint',
    type: 'POST',
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        // other data
    }
});
```

### 3. Handle Long-Running Forms

For forms that users might leave open for extended periods:

```javascript
// Refresh token before submitting
async function submitForm() {
    await window.csrfHandler.refreshToken();
    // Submit form
}
```

### 4. Session Configuration

Ensure proper session configuration in `.env`:

```env
SESSION_LIFETIME=120
SESSION_DRIVER=file
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=false
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

## Debugging 419 Errors

### 1. Check Browser Console

Look for CSRF-related errors in the browser console.

### 2. Verify Meta Tag

Ensure the CSRF token meta tag is present:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### 3. Check Network Tab

In browser dev tools, verify that requests include the `X-CSRF-TOKEN` header.

### 4. Session Debugging

Add temporary debugging to check session state:

```php
// In your controller
dd([
    'session_token' => session()->token(),
    'request_token' => request()->input('_token'),
    'header_token' => request()->header('X-CSRF-TOKEN')
]);
```

## Common Issues and Solutions

### Issue: "CSRF token not found" error

**Solution**: Ensure the meta tag is in your layout:

```blade
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
```

### Issue: AJAX requests fail with 419

**Solution**: Use the configured axios or include CSRF token manually:

```javascript
// Using configured axios (recommended)
axios.post('/endpoint', data);

// Manual CSRF token
$.ajax({
    url: '/endpoint',
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: data
});
```

### Issue: Forms work but AJAX doesn't

**Solution**: Check if axios is properly configured and loaded:

```javascript
// Check if axios is available
console.log(window.axios);

// Check if CSRF handler is loaded
console.log(window.csrfHandler);
```

### Issue: Multiple tabs causing issues

**Solution**: The CSRF handler automatically refreshes tokens, but you can also:

```javascript
// Listen for storage events to sync tokens across tabs
window.addEventListener('storage', function(e) {
    if (e.key === 'csrf_token') {
        window.csrfHandler.setToken(e.newValue);
    }
});
```

## Testing

### 1. Test Form Submission

Submit forms and verify they work without 419 errors.

### 2. Test AJAX Requests

Make AJAX requests and check network tab for proper headers.

### 3. Test Token Expiration

Wait for token expiration and verify automatic refresh works.

### 4. Test Error Handling

Temporarily break CSRF protection to test error messages.

## Additional Resources

- [Laravel CSRF Documentation](https://laravel.com/docs/csrf)
- [Axios Documentation](https://axios-http.com/docs/intro)
- [Laravel Session Configuration](https://laravel.com/docs/session)


