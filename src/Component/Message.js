import React, { useState } from 'react';


const Message = (e) => {

    const [email, setEmail] = useState('');
    const [message, setMessage] = useState('');
    const [dataSend, setDataSend] = useState();
    const [showMessage, setShowMessage] = useState('');
    const [dataReceive, setDataReceive] = useState();

    async function send_message(e) {
        e.preventDefault();

        if (email.length == 0 && message.length == 0) {
            alert("Enter Email and Message")
            return
        }

        //  make sure while sending POST request from react to laravel,
        // commit    // \App\Http\Middleware\VerifyCsrfToken::class,  in web section in kernal.php 

        try {

            await fetch('http://127.0.0.1:8000/reactmessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email,
                    message,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    // Access the JSON response
                    console.log(data);
                    setEmail('');
                    setMessage('');
                    setDataSend(true);
                })
                .catch((error) => {
                    // Handle errors here
                    console.error(error);
                    setDataSend(false);
                });



        } catch (error) {
            // Handle errors here
            console.error(error);
        }


    }

    async function getData(e) {

        e.preventDefault();

        try {

            const getting_data = await fetch('http://127.0.0.1:8000/getmessage', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })

            const resp = await getting_data.json();

            console.log(resp);

            if (resp) {
                setShowMessage(resp);
                setDataReceive(true);
            }

        }
        catch (e) {
            console.log("Error: ", e);
            setDataReceive(false);
        }

    }


    return (
        <div>
            <h2 style={{ textAlign: "center" }}>Message</h2>
            <h5 style={{ textAlign: "center" }}>message will be send to laravel backend</h5>
            <form style={{ display: 'flex', flexDirection: "column", alignItems: "center", justifyContent: "center" }} onSubmit={send_message}>
                <h4>Email</h4>
                <input type="email" name="email" placeholder='Enter Email' value={email} onChange={(e) => setEmail(e.target.value)} required />
                <br></br>
                <h4>Message</h4>
                <input type="text" name="message" placeholder='Enter Message' value={message} onChange={(e) => setMessage(e.target.value)} required />
                <br></br>

                {dataSend ? (
                    <p>Message Sent Successfully</p>
                ) : (
                    null
                )}

                {dataSend == false ? (
                    <p>Fail to Send Message <br></br><span>check console</span></p>

                ) : (
                    null
                )}
                <button type="submit" >Send Message</button>
            </form>
            <br></br>
            <hr></hr>

            <form style={{ display: 'flex', flexDirection: "column", alignItems: "center", justifyContent: "center" }} onSubmit={getData}>

                {showMessage == '' ?
                    (<p>No data</p>) : (<p>{showMessage}</p>)
                }
                <br></br>

                {dataReceive==false ?
                    (<p>Fail to fetch data <span>check console</span></p>) :
                    (null)
                }
                <button type='submit'>View Message</button>
            </form>
        </div>

    );
};

export default Message;