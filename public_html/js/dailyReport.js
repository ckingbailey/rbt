(function() {
    // TODO: make a fn to prevent more than 2-3 lines being added if lines are left empty
    
    const form = document.forms['dailyReportForm'];
    const submitEvent = new window.Event('submit');
    
    const activityCount = [];
    
    // this counter will be used to count input lines
    let count = 0;
    
    // The Submit handler
    function handleSubmit() {
        const endpoint = 'submitIDR.php';
        const data = new FormData(form);
        
        window.fetch(endpoint, {
            method: 'POST',
            body: data
        }).then(res => {
            if (res.ok) {
                if (res.headers.get('Location') && res.status === 201) {
                    window.location.href = res.headers.get('Location');
                    return res.text()
                } else {
                    // no Location || no New Record status (although php may have created some new records)
                    window.alert('There was a problem with the redirect and/or INSERT');
                    throw Error(`${res.status} ${res.headers['Content-Type']} ${res.headers['Content-Length']} ${res.headers['Location']}`);
                }
            } else if (res.status === 500) {
                return res.text();
            }
            else {
                throw Error(res.statusText);
            }
        }).then(text => {
            if (!text.then) {
                window.alert(`Thank you for your submission\n${text}`);
            } else {
                // text is an unresolved promise. try to resolve it with another `then`
                text.then(body => {
                    window.alert('There was a problem with the request');
                });
            }
        }).catch(err => {
            window.alert('There was a problem with the request:\n' + err);
        })
    }
    
    // handlers for elements that occur only once
    form.addEventListener('submit', event => {
        event.preventDefault();
        return handleSubmit();
    })
    document.getElementById('addLineBtn')
        .addEventListener('click', event => {
            count++;
            return addNewLine(event, count);
        });
        
    // add ev listeners on default (first) rendered line
    document.getElementById('selectEquipLabor_0')
        .addEventListener('change', event => {
            return renderLabelText(event, 0);
        });
    document.getElementById('showNotes_0')
        .addEventListener('click', event => {
            return showNotesField(event, 0);
        });
    document.getElementById('actInput_0')
        .addEventListener('keypress', event => {
            return handleKeypressEnter(event, 0);
        });
    document.getElementById('hours_0')
        .addEventListener('keypress', event => {
            return handleKeypressEnter(event, 0);
        });
    document.getElementById('addAct_0')
        .addEventListener('click', event => {
            return addActToList(event, 0);
        });
    // document.getElementById('actList_0')
    //     .addEventListener('input', event => {
    //         return handleActSelect(event, 0);
    //     });
    // document.getElementById('hours_0')
    //     .addEventListener('change', event => {
    //         return updateHours(event, 0);
    //     });
    
    // focus handlers
    function submitActHrs(ev, num) {
        const curList = document.getElementById('actList_'+ num);
        const curHrs = document.getElementById('hours_' + num);
        if (!curList.value.trim().length) {
            curHrs.value = '';
            return;
        } else {
            const curInput = document.getElementById('actInput_' + num);
            const curID = curList.selectedOptions[0].uniqueID;
    
            updateHours(ev, num);

        }
    }
        
    // handlers that get/set json data
    // function handleActSelect(ev, num) {
    //     const hrsEl = document.getElementById('hours_' + num);
    //     // get actList obj from state
    //     const selectedOptID = ev.target.selectedOptions[0].uniqueID;
        
    //     // select hours_ form control corresponding to num
    //     hrsEl.value = formState.actLists[num][selectedOptID].hrsVal;
    //     hrsEl.focus();
    // }
    
    // function updateHours(ev, num) {
    //     const curList = document.getElementById('actList_' + num);
    //     const curID = curList.selectedOptions[0].uniqueID;
    //     formState.actLists[num][curID].hrsVal = ev.target.value;
            
    //     // reset hours values
    //     resetActInputs(ev, num);


    // }
    
    function addActToList(ev, num) {
        // BEWARE: event.target may be the <i> icon
        const curGrp = document.getElementById('workInputGroup_' + num).children[1];
        let curList = document.getElementById('activityList_' + num);
        const curDesc = document.getElementById('actInput_' + num);
        const curNum = document.getElementById('numEquipOrLabor_' + num);
        const curHrs = document.getElementById('hours_' + num);
        const equipOrPersons = document.getElementById('selectEquipLabor_' + num).value === 'equipment' ?
            'equip.' : 'pers.';
        
        if (!curDesc.value.trim() || !curNum.value.trim() || !curHrs.value.trim()) {
            return;
        } else {
            // QUESTION: how does a new line get its Act number?
            // ANSWER: use an array of numbers to keep track of what activity # I'm at for each labor or equip index
            if (!activityCount[num]) {
                activityCount[num] = 0;
            }
            activityCount[num] += 1;
        
            if (!curList) {
                curList = curGrp.appendChild(document.createElement('div'));
                curList.setAttribute('id', 'activityList_' + num);
                curList.classList.add('col-12');
            }
            const newActLine = curList.appendChild(document.createElement('div'));
            const col1 = newActLine.appendChild(document.createElement('div'));
            const col2 = newActLine.appendChild(document.createElement('div'));
            const col3 = newActLine.appendChild(document.createElement('div'));
            
            let label = col1.appendChild(document.createElement('label'));
            label.appendChild(document.createTextNode('Task/activity'));
            label.classList.add('input-label', 'item-margin-right', 'required');
            const actDesc = col1.appendChild(document.createElement('input'));
            
            label = col2.appendChild(document.createElement('label'));
            label.appendChild(document.createTextNode('# ' + equipOrPersons));
            label.setAttribute('id', `numRsrcLabel_${num}_${activityCount[num]}`);
            label.classList.add('input-label', 'item-margin-right', 'required');
            const numRsrcs = col2.appendChild(document.createElement('input'));
            
            label = col3.appendChild(document.createElement('label'));
            label.appendChild(document.createTextNode('Hours'))
            label.classList.add('input-label', 'item-margin-right', 'required');
            const actHrs = col3.appendChild(document.createElement('input'));
            newActLine.classList.add('row', 'pad-less', 'blue-striped', 'item-border-bottom');
            col1.classList.add('col-md-6', 'flex-row', 'align-center');
            col2.classList.add('col-md-3', 'mw-50', 'flex-row', 'align-center');
            col3.classList.add('col-md-3', 'mw-50', 'flex-row', 'align-center');
            actDesc.classList.add('form-control', 'subtle');
            actDesc.setAttribute('name', `actDesc_${num}_${activityCount[num]}`);
            actDesc.value = curDesc.value;
            numRsrcs.classList.add('form-control', 'subtle', 'mw-33');
            numRsrcs.setAttribute('name', `numResources_${num}_${activityCount[num]}`);
            numRsrcs.value = curNum.value;
            actHrs.classList.add('form-control', 'subtle', 'mw-33');
            actHrs.setAttribute('name', `actHrs_${num}_${activityCount[num]}`);
            actHrs.value = curHrs.value;
        }
    }
    
    function handleKeypressEnter(ev, num) {

        ev.stopPropagation();
        if (ev.key === 'Enter') {
            ev.preventDefault();
            if (ev.target.id.includes('actInput_')) {
                return addActToList(ev, num);
            }
            // else if (ev.target.id.includes('hours_')) {
            //     return submitActHrs(ev, num);
            // }
            else ev.target.dispatchEvent(submitEvent);
        }
    }

    // handlers to show/hide DOM elements
    function renderLabelText(event, num) {
        const locInput = document.getElementById('locationID_' + num);
        const totLabel = document.getElementById('labelTotalEquipLabor_' + num);
        const descLabel = document.getElementById('labelDescEquipLabor_' + num);
        const numLabel = document.getElementById('labelNumEquipLabor_' + num);
        const totInput = document.getElementById('equipOrLaborTotal_' + num);
        const descInput = document.getElementById('equipOrLaborDesc_' + num);
        const numInput = document.getElementById('numEquipOrLabor_' + num);
        const textarea = document.getElementById('notes_' + num);
        const actList = document.getElementById('activityList_' + num);
        if (event.target.value == 'labor') {
            locInput.setAttribute('name', 'laborLocationID_' + num);
            totLabel.innerText = 'Tot. personnel';
            descLabel.innerText = 'Description of Labor';
            numLabel.innerText = '# of personnel';
            totInput.setAttribute('name', 'laborTotal_' + num);
            descInput.setAttribute('name', 'laborDesc_' + num);
            textarea.setAttribute('name', 'laborNotes_' + num);
            if (actList) {
                for (let row of actList.children) {
                    const curLabel = row.children[1].querySelector('label');
                    curLabel.innerText = '# pers.';
                }
            }
        } else {
            locInput.setAttribute('name', 'equipLocationID_' + num);
            totLabel.innerText = 'Tot. equipment';
            descLabel.innerText = 'Description of Equipment';
            numLabel.innerText = '# of equip.';
            totInput.setAttribute('name', 'equipTotal_' + num);
            descInput.setAttribute('name', 'equipDesc_' + num);
            textarea.setAttribute('name', 'equipNotes_' + num);
            if (actList) {
                for (let row of actList.children) {
                    const curLabel = row.children[1].querySelector('label');
                    curLabel.innerText = '# equip.';
                }
            }
        }
    }
    
    function showNotesField(event, num) {
        const notesField = document.getElementById('notesField_' + num);
        if (notesField.style.display === 'none') notesField.style.display = 'block';
        else notesField.style.display = 'none';
    }
    
    function addNewLine(event, num) {
        const parentEl = document.getElementById('workInputList');
        const locChildEls = [];
        for (let id in window.locJSON) {
            locChildEls.push(
                {
                    tagName: 'option',
                    innerText: window.locJSON[id],
                    value: id
                }
            );
        }

        /* each of these element objects takes:
            {
                tagName: '...',
                label: '...' || [],
                type: '...',
                id: '...',
                name: '...',
                classList: '...' || [],
                style: '...',
                innerText: '...',
                handlers: [
                    {
                        event: '',
                        fn: function
                    }
                ],
                siblings: [{}],
                children: [{}]
            }
        */
        const formCtrls = {
            firstRow: [
                {
                    tagName: 'select',
                    label: 'Location',
                    type: null,
                    id: 'locationID',
                    name: 'laborLocationID',
                    classList: 'form-control',
                    style: null,
                    children: locChildEls
                },
                {
                    tagName: 'select',
                    label: 'Equip/Labor',
                    type: null,
                    id: 'selectEquipLabor',
                    classList: 'form-control',
                    style: null,
                    handlers: [
                        {
                            event: 'change',
                            fn: renderLabelText
                        }
                    ],
                    children: [
                        {
                            tagName: 'option',
                            innerText: 'Labor',
                            value: 'labor'
                        },
                        {
                            tagName: 'option',
                            innerText: 'Equipment',
                            value: 'equipment'
                        }
                    ]
                },
                {
                    tagName: 'input',
                    label: {

                        innerText: 'Description of labor',
                        id: 'labelDescEquipLabor'
                    },
                    type: 'text',
                    id: 'equipOrLaborDesc',
                    name: 'laborDesc',
                    classList: ['form-control', 'full-width'],
                    style: null,
                    handlers: null
                },
                {
                    tagName: 'input',
                    label: {
                        innerText: 'Tot. personnel',
                        id: 'labelTotalEquipLabor'
                    },
                    type: 'number',
                    id: 'equipOrLaborTotal',
                    name: 'laborTotal',
                    classList: 'form-control',
                    style: null,
                    handlers: null
                },
                {
                    tagName: 'button',
                    label: 'Notes',
                    type: 'button',
                    id: 'showNotes',
                    name: null,
                    classList: 'form-control',
                    style: 'width: 40px',
                    handlers: [
                        {
                            event: 'click',
                            fn: showNotesField
                        }
                    ],
                    innerText: null,
                    children: [
                        {
                            tagName: 'i',
                            classList: ['typcn', 'typcn-document-text']
                        }
                    ],
                    siblings: [
                        {
                            tagName: 'aside',
                            id: 'notesField',
                            style: 'display: none; position: absolute; right: 50px; bottom: -2px; border: 1px solid rgba(51, 51, 51, 0.2); width: 260px; padding: 0.25rem; background-color: white;',
                            children: [
                                {
                                    tagName: 'textarea',
                                    id: 'notes',
                                    name: 'laborNotes',
                                    rows: '5',
                                    cols: '30',
                                    maxlength: '125',
                                    classList: 'form-control'
                                }
                            ]
                        }
                    ]
                }
            ],
            secondRow: [
                {
                    tagName: 'input',
                    label: 'Description of task/activity',
                    type: 'text',
                    id: 'actInput',
                    name: null,
                    classList: ['form-control', 'full-width'],
                    style: null,
                    handlers: [
                        {
                            event: 'keypress',
                            fn: handleKeypressEnter
                        }
                    ],
                    innerText: null
                },
                {
                    tagName: 'input',
                    label: {
                        innerText: '# persons',
                        id: 'labelNumEquipLabor'
                    },
                    type: 'number',
                    id: 'numEquipOrLabor',
                    name: null,
                    classList: 'form-control',
                    style: null,
                    handlers: null,
                    innerText: null,
                    children: null
                },
                {
                    tagName: 'input',
                    label: 'Hours',
                    type: 'number',
                    id: 'hours',
                    name: null,
                    classList: ['form-control', 'full-width'],
                    style: null,
                    handlers: null,
                    innerText: null
                },
                {
                    tagName: 'button',
                    label: 'Add Task',
                    type: 'button',
                    id: 'addAct',
                    name: null,
                    classList: ['btn', 'btn-success', 'block'],
                    style: null,
                    handlers: [
                        {
                            event: 'click',
                            fn: addActToList
                        }
                    ],
                    innerText: 'Add',
                    children: [
                        {
                            tagName: 'i',
                            classList: ['typcn', 'typcn-chevron-right-outline']
                        }
                    ]

                }
            ]
        }
        
        // specific DOM elements
        const newGroup = document.createElement('div');
        newGroup.classList.add('col-12', 'item-border-bottom', 'item-margin-bottom');
        newGroup.setAttribute('id', 'workInputGroup_' + num);

        // append first row of inputs
        const firstRow = document.createElement('div');
        firstRow.classList.add('row', 'item-margin-bottom');
        newGroup.appendChild(firstRow);
        
        const secondRow = document.createElement('div');
        secondRow.classList.add('row', 'item-margin-bottom', 'pad', 'border-radius', 'grey-bg');
        newGroup.appendChild(secondRow);
        
        appendNextRow(formCtrls.firstRow, firstRow, num);
        appendNextRow(formCtrls.secondRow, secondRow, num);
        
        // add some additional classes to particular formCtrl parents
        firstRow.children[0].classList.add('col-md-2', 'pl-1', 'pr-1');
        firstRow.children[1].classList.add('col-md-2', 'pl-1', 'pr-1');
        firstRow.children[2].classList.add('col-md-5', 'pl-1', 'pr-1');
        firstRow.children[3].classList.add('col-md-2', 'pl-1', 'pr-1', 'mw-50');
        firstRow.children[4].classList.add('col-md-1', 'pl-1', 'pr-1', 'flex-column', 'align-end', 'mw-50');
        secondRow.children[0].classList.add('col-md-6', 'pl-1', 'pr-1', 'item-margin-bottom');
        secondRow.children[1].classList.add('col-md-3', 'pl-1', 'pr-1', 'mw-33', 'item-margin-bottom');
        secondRow.children[2].classList.add('col-md-2', 'pl-1', 'pr-1', 'mw-33', 'item-margin-bottom');
        secondRow.children[3].classList.add('col-md-1', 'pl-1', 'pr-1', 'mw-33', 'item-margin-bottom');
        
        parentEl.appendChild(newGroup);
    }
    
    function appendNextRow(elements, row, num) {
        let label;
        let curCtrl;

        for (let ctrl of elements) {
            // for each one append a div.item-margin-right
            const curParent = row.appendChild(document.createElement('div'));

            // then loop over ctrl keys
            curCtrl = curParent.appendChild(document.createElement(ctrl.tagName));
            for (let prop in ctrl) {
                if (prop === 'tagName') continue;
                // first append label
                if (ctrl[prop]) {
                    if (prop === 'label') {
                        if (typeof ctrl[prop] === 'object') {
                            label = curCtrl.insertAdjacentElement('beforebegin', document.createElement('label'));
                            label.innerText = ctrl.label.innerText;
                            label.id = ctrl.label.id + '_' + num;
                        }
                        else {
                            curCtrl.insertAdjacentElement('beforebegin', document.createElement('label')).appendChild(document.createTextNode(ctrl.label));
                        }
                    }
                    
                    // then append form control element
                    else if (prop === 'innerText') curCtrl.innerText = ctrl[prop];
                    else if (prop === 'classList') {
                        if (typeof ctrl[prop] === 'object') {
                            for (let className of ctrl[prop]) {
                                curCtrl.classList.add(className);
                            }
                        } else curCtrl.classList.add(ctrl[prop]);
                    }
                    else if (prop === 'handlers') {
                        for (let handler of ctrl[prop]) {
                            curCtrl.addEventListener(handler.event, ev => {
                                handler.fn(ev, num);
                            })
                        }
                    }
                    else if (prop === 'children') {
                        let curChild;
                        for (let child of ctrl.children) {
                            curChild = curCtrl.appendChild(document.createElement(child.tagName));
                            for (let attr in child) {
                                if (attr === 'tagName') continue;
                                else if (attr === 'innerText') curChild.innerText = child[attr];
                                else if (attr === 'classList') {
                                    for (let className of child[attr]) {
                                        curChild.classList.add(className);
                                    }
                                } else if (attr === 'handlers') {
                                    for (let handler of child[attr]) {
                                        curChild.addEventListener(handler.event, ev => {
                                            return handler.fn(ev, num);
                                        });
                                    }
                                } else curChild.setAttribute(attr, child[attr]);
                            }
                        }
                    }
                    else if (prop === 'siblings') {
                        let curSib;
                        let curChild;
                        for (let sib of ctrl.siblings) {
                            curSib = curCtrl.insertAdjacentElement('afterend', document.createElement(sib.tagName));
                            for (let attr in sib) {
                                if (attr === 'children') {
                                    for (let child of sib[attr]) {
                                        curChild = curSib.appendChild(document.createElement(child.tagName));
                                        for (let childAttr in child) {
                                            if (childAttr === 'tagName') continue;
                                            else if (childAttr === 'name' || childAttr === 'id') curChild.setAttribute(childAttr, `${child[childAttr]}_${num}`);
                                            else if (childAttr === 'classList') {
                                                if (typeof child[childAttr] !== 'string') {
                                                    for (let className of childAttr) {
                                                        curChild.classList.add(childAttr[className]);
                                                    }
                                                } else curChild.classList.add(child[childAttr]);
                                            } else if (childAttr === 'handler') {
                                                for (let handler of childAttr) {
                                                    curChild.addEventListener(handler.event, ev => {
                                                        return handler.fn(ev, num);
                                                    })
                                                }
                                            } else curChild.setAttribute(childAttr, child[childAttr])
                                        }
                                    }
                                }
                                else if (attr === 'name' || attr === 'id') curSib.setAttribute(attr, `${sib[attr]}_${num}`);
                                else {
                                    curSib.setAttribute(attr, sib[attr]);
                                }
                            }
                        }
                    }
                    else if (prop === 'id' || prop === 'name') {
                        curCtrl.setAttribute(prop, ctrl[prop] + '_' + num);
                    }
                    else curCtrl.setAttribute(prop, ctrl[prop]);
                }
            }
        }
    }

    function destroyLine(num) {
        // when user destroys line, also destory corresponding formState obj
    }
    
    // utils
    function newUniqueID(prevKeys) {
        // if no prevKeys, set it to an empty array
        prevKeys = prevKeys || [];
        let uniqueID = (new Date().getTime()).toString(16);
        let i = 0;
        if (!prevKeys.includes(uniqueID)) {
            formState.keys.push(uniqueID);
            return uniqueID;
        } else {
            while (prevKeys.includes(uniqueID)) {
                uniqueID = (new Date().getTime()).toString(16);
                i++;
                if (i > 99) break;
            }
            formState.keys.push(uniqueID);
            return uniqueID;
        }
        
    }
})()
