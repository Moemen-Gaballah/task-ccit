function notifyMsg(msg, status= "success"){
    cuteToast({
        type: status, // or 'info', 'error', 'warning'
        message: msg,
        timer: 3000
    });
}
