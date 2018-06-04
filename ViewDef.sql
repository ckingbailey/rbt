SELECT 
    D.OldID,
    L.LocationName,
    D.SpecLoc,
    S.SeverityName,
    D.Description,
    D.Spec,
    DATE_FORMAT(D.DateCreated, "%d %b %Y"),
    T.Status,
    D.IdentifiedBy,
    Y.System,
    Y1.System,
    D.ActionOwner,
    E.EviType,
    D.EvidenceLink,
    D.DateClosed,
    D.LastUpdated,
    D.Updated_by,
    D.Created_by,
    D.Comments,
    R.RequiredBy,
    c.contract,
    p.Repo,
    D.ClosureComments,
    D.DueDate,
    yn.YesNo,
    dt.defTypeName
FROM CDL D
LEFT JOIN RequiredBy R
ON R.ReqByID = D.RequiredBy
LEFT JOIN Location L
ON L.LocationID = D.Location
LEFT JOIN Severity S
ON D.Severity = S.SeverityID
LEFT JOIN Status T
ON D.Status = T.StatusID
LEFT JOIN System Y
ON D.SystemAffected = Y.SystemID
LEFT JOIN System Y1
ON D.GroupToResolve = Y1.SystemID
LEFT JOIN EvidenceType E
ON D.EvidenceType = E.EviTypeID
LEFT JOIN Contract c
ON D.contractID=c.contractID
LEFT JOIN YesNo yn
ON D.SafetyCert=yn.YesNoID
LEFT JOIN Repo p
ON D.Repo=p.repoID
LEFT JOIN defType dt
ON D.defType=dt.defTypeID
Where DefID=
