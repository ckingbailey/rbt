SELECT 
    A.CertID,
    A.Item,
    A.Requirement,
    A.DesignCode,
    A.DesignSpec,
    C.Contract,
    A.ControlNo,
    E.ElementGroup,
    S.CertifiableElement
FROM
    SafetyCert A
LEFT JOIN 
    Contract C
ON 
    C.ContractID = A.ContractNo
LEFT JOIN 
    ElementGroup E
ON 
    E.EG_ID = A.ElementGroup
LEFT JOIN 
    CertifiableElement S
ON 
    S.CE_ID = A.CertElement
ORDER BY A.Item
