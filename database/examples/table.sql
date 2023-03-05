SELECT id, name, email, created_at
FROM users
WHERE created_at BETWEEN @start AND @end
ORDER BY created_at ASC