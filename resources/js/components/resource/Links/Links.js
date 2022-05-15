import React from 'react';
import BasicResourceComponent from "../BasicResourceElements/BasicResourceComponent";
import LinkAdder from "./LinkAdder";
import SingleLink from "./SingleLink";
import SingleLinkEditing from "./SingleLinkEditing";

export  default function Links() {

    return (
        <BasicResourceComponent
            ElementAdder={LinkAdder}
            DefaultComponent={SingleLink}
            EditingComponent={SingleLinkEditing}
            MainElementComponent={SingleLink}
            name="link"
        />
    );
}
