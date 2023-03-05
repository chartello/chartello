SELECT COUNT(*) AS y, DATE(created_at) AS x
FROM users
WHERE created_at BETWEEN @start AND @end
GROUP BY x
ORDER BY x ASC