import React, { useState, useEffect } from 'react';
import AsyncSelect from 'react-select/async';
import RequestHelper from "../../../helpers/RequestHelper";

export default function SingleLinkEditing(props) {

    const requestHelper = new RequestHelper();

    let defaultSelectValue = {};
    if (props.hasOwnProperty('image_name') && props.hasOwnProperty('image_id')) {
        defaultSelectValue = {id: props.image_id, name: props.image_name};
    }

    const [selectedValue, setSelectedValue] = useState(defaultSelectValue);

    const [imageOptions, setImageOptions] = useState({});
    const [message, setMessage] = useState('');
    const [editingProps, setEditingProps] = useState({
        visits_left: props.visits_left ?? 10,
        expires_at: props.expires_at ?? '',
    });

    const visitsLeftMax = 999;

    useEffect(
        () => {
            save();
        },[props.isSaving]
    );

    /**
     * Validates data and sends save request
     */
    const save = () => {
        if (props.isSaving) {

            let errorMessages = [];

            if (!selectedValue || !selectedValue.hasOwnProperty('id')) {
                errorMessages.push('Please select an image');
            }
            if (Number(editingProps.visits_left) > {visitsLeftMax}) {
                errorMessages.push('"Visits left" property is too long');
            }
            if (errorMessages.length) {
                props.handleSavingFail(errorMessages.join(', '));
            } else {
                let newValues = editingProps;
                newValues['image_id'] = selectedValue.id;
                props.saveResource(newValues);
            }
        } else {
            setMessage('');
        }
    }

    const handleImageSelectChange = value => {
        setSelectedValue(value);
    }

    /**
     * Load images' names for selecting
     * @param searchValue
     * @returns {Promise<*>}
     */
    const loadImagesData = async (searchValue) => {
        let response = await requestHelper.get('images?search_text=' + searchValue);
        if (response.status === 200) {
            return response.data;
        }
    }

    /**
     * Common function for editing all non-select params
     * @param event
     */
    const handleTextEditing = (event) => {
        let value = event.target.value;
        let name = event.target.name;

        if (name === 'visits_left') {
            value = Number(value);
            value = Math.min(value, visitsLeftMax);
        }

        setEditingProps(prevState => {
            prevState[name] = value;
            return {...prevState};
        })
    }

    const selectImageStyles = {
        option: (provided, state) => ({
            ...provided,
            color: state.isSelected ? '#000000' :
                '#1e1f21',
        }),
    };

    return (
        <React.Fragment>
            <div className="single-link__ref">
                <a href={props.link} target="_blank">{props.link}</a>
            </div>
            <div className="row mt-4">
                <div className="col-12">
                    <label className="w-100">
                        <div className="row">
                            <div className="col-2">
                                Image:
                            </div>

                            <div className="col-9">
                                <AsyncSelect
                                    cacheOptions
                                    defaultOptions
                                    placeholder="Search starts when at least 4 characters are typed"
                                    options={imageOptions}
                                    getOptionLabel={e => e.name}
                                    getOptionValue={e => e.id}
                                    loadOptions={loadImagesData}
                                    onChange={handleImageSelectChange}
                                    styles={selectImageStyles}
                                />
                            </div>
                        </div>
                    </label>
                </div>
                <div className="col-12 mt-2">
                    <label className="w-100">
                        <div className="row">
                            <div className="col-2">
                                Visits left ({visitsLeftMax} max):
                            </div>
                            <div className="col-9">
                                <input type="number" max={visitsLeftMax} value={editingProps.visits_left} name="visits_left" onChange={handleTextEditing} />
                            </div>
                        </div>
                    </label>
                </div>
                <div className="col-12 mt-2">
                    <label className="w-100">
                        <div className="row">
                            <div className="col-2">
                                Expires at:
                            </div>
                            <div className="col-9">
                                <input type="date" value={editingProps.expires_at} name="expires_at" onChange={handleTextEditing}/>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div className="row">
                <div className="col-12">
                    {message}
                </div>
            </div>
        </React.Fragment>
    );
}
