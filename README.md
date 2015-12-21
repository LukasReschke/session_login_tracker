# session_login_tracker
Application to log used sessions when authenticated as well as detect reuse.

Used for debugging purposes.

### Configuration

* if the PHP session is stored within memcache following line needs to be adjusted: https://github.com/LukasReschke/session_login_tracker/blob/6abc0379dd6d8987181d4d63afe217bbc8dfdffa/lib/hooks.php#L75
