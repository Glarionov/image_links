import React from 'react';
import SingleLinkEditing from "./SingleLinkEditing";

export default function LinkAdder() {
    return (
        <div className="link-adder bg-dark p-3 mb-5">
            <h6 className="display-6">Create new link</h6>
            <SingleLinkEditing />
            <button className="btn-success mt-3">
                Save
            </button>
        </div>
    );
}
