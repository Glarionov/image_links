import React from 'react';

export default function SingleLink(props) {
    return (
        <React.Fragment>
            <div className="single-link__ref">
                <a href={props.link} target="_blank">{props.link}</a>
            </div>
            <div className="row mt-2 single-link__data">
                <div className="col-12 col-md-3">
                    Image: <b>{props.image_name}</b>
                </div>
                <div className="col-12 col-md-3">
                    Visits left: <b>{props.visits_left}</b>
                </div>
                {props.expires_at && <div className="col-12 col-md-3">
                    Expires at: <b>{props.expires_at_pretty}</b>
                </div>}
            </div>
        </React.Fragment>
    );
}
