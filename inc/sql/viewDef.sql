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
    D.updatedBy as updatedBy,
    D.createdBy as createdBy,
    R.milestoneName as milestoneName,
    c.contractName as contract,
    p.docRepoName as documentRepo,
    D.closureComments as closureComments,
    D.dueDate as dueDate,
    yn.yesNoName as safetyCert,
    dt.defTypeName as defType
FROM deficiency D
LEFT JOIN milestone R
ON R.milestoneID = D.milestone
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
ON D.contract = c.contractID
LEFT JOIN yesNo yn
ON D.SafetyCert = yn.YesNoID
LEFT JOIN documentRepo p
ON D.documentRepo = p.docRepoID
LEFT JOIN defType dt
ON D.defType = dt.defTypeID
where DefID =
