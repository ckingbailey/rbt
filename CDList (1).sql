SELECT 
    D.DefID,
    L.LocationName,
    S.SeverityName,
    DATE_FORMAT(D.DateCreated, "%d %b %Y"),
    T.Status,
    Y.System,
    D.Description,
    D.LastUpdated
FROM
    CDL D
LEFT JOIN 
    Location L
ON 
    L.LocationID = D.Location
LEFT JOIN 
    Severity S
ON 
    D.Severity = S.SeverityID
LEFT JOIN 
    Status T
ON 
    D.Status = T.StatusID
LEFT JOIN 
    System Y
ON 
    D.SystemAffected = Y.SystemID
WHERE
    D.Status <> 3
ORDER BY DefID;
