document.addEventListener("DOMContentLoaded", async () => {
    const res = await app.get("callback.logs");

    const box = document.getElementById("callbackLogText");

    if (res.error) {
        box.innerText = "(error)";
        return;
    }

    // convert array/object to pretty JSON
    box.innerText = JSON.stringify(res.data, null, 2);
});
