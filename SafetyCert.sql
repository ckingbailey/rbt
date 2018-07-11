SELECT 
    A.CertID,
    A.Item,
    A.Requirement,
    A.DesignCode,
    A.DesignSpec,
    C.ContractName,
    A.ControlNo,
    E.ElementGroup,
    S.CertifiableElement
FROM
    safetyCert A
LEFT JOIN 
    contract C
ON 
    C.ContractID = A.ContractNo
LEFT JOIN 
    elementGroup E
ON 
    E.EG_ID = A.ElementGroup
LEFT JOIN 
    certifiableElement S
ON 
    S.CE_ID = A.CertElement
ORDER BY A.Item
