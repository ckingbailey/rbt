SELECT
    c.DefID as ID,
    l.LocationName as location,
    s.SeverityName as severity,
    DATE_FORMAT(c.DateCreated, "%d %b %Y") as dateCreated,
    t.StatusName as status,
    y.SystemName as systemAffected,
    SUBSTR(c.Description, 1, 50) as description,
    c.SpecLoc as specLoc,
    c.LastUpdated as lastUpdated
FROM
    CDL c
LEFT JOIN
    location l
ON
    l.LocationID = c.Location
LEFT JOIN
    severity s
ON
    c.Severity = s.SeverityID
LEFT JOIN
    status t
ON
    c.Status = t.StatusID
LEFT JOIN
    system Y
ON
    c.SystemAffected = y.SystemID
