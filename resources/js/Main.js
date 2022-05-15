import React from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import { transitions, positions, Provider as AlertProvider } from 'react-alert'
import AlertTemplate from 'react-alert-template-basic'

import Links from "./components/resource/Links/Links";

const alertOptions = {
    position: positions.MIDDLE,
    transition: transitions.SCALE,
}

function Main() {
    return (
        <div className="container">
            <AlertProvider template={AlertTemplate} {...alertOptions}>
                <Links />
            </AlertProvider>
        </div>
    );
}

export default Main;

if (document.getElementById('main')) {
    ReactDOM.render(<Main />, document.getElementById('main'));
}
