SELECT
    D.OldID as oldID,
    L.locationName as location,
    D.specLoc as specLoc,
    S.severityName as severity,
    D.description as description,
    D.spec as spec,
    DATE_FORMAT(D.DateCreated, "%d %b %Y") as dateCreated,
    T.statusName as status,
    D.identifiedBy as identifiedBy,
    Y.systemName as systemAffected,
    Y1.systemName as GroupToResolve,
    D.actionOwner as actionOwner,
    E.eviTypeName as evidenceType,
    D.evidenceLink as evidenceLink,
    D.dateClosed as dateClosed,
    D.lastUpdated as lastUpdated,
    D.updated_by as updated_by,
    D.created_by as created_by,
    D.comments as comments,
    R.requiredBy as requiredBy,
    c.contractName as contract,
    p.repoName as repo,
    D.closureComments as closureComments,
    D.dueDate as dueDate,
    yn.yesNoName as safetyCert,
    dt.defTypeName as defType
FROM CDL D
LEFT JOIN requiredBy R
ON R.ReqByID = D.RequiredBy
LEFT JOIN location L
ON L.LocationID = D.Location
LEFT JOIN severity S
ON D.Severity = S.SeverityID
LEFT JOIN status T
ON D.Status = T.StatusID
LEFT JOIN system Y
ON D.SystemAffected = Y.SystemID
LEFT JOIN system Y1
ON D.GroupToResolve = Y1.SystemID
LEFT JOIN evidenceType E
ON D.EvidenceType = E.EviTypeID
LEFT JOIN contract c
ON D.contractID=c.contractID
LEFT JOIN yesNo yn
ON D.SafetyCert=yn.YesNoID
LEFT JOIN repo p
ON D.Repo=p.repoID
LEFT JOIN defType dt
ON D.defType=dt.defTypeID
Where DefID=
