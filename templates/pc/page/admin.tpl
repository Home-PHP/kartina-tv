
<style>
    FORM.admin {
        background: #efe url("/images/bg.gif") repeat scroll 0 0;
        color: #000;
        border: 2px solid gray;
        padding: 3px;
    }

    FORM.admin P {
        orphans: 3;
        widows: 3;
        margin: 0.3em 0 1.1em;
    }

    FORM.admin input {
        margin-left: 0;
        outline: 0 none;
    }
    FORM.admin input[type="text"] {
        width: 200px;
        background: #fff none repeat scroll 0 0;
        border: medium none;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1) inset;
        color: #525252;
        padding: 6px 0;
    }
    FORM.admin input:focus, FORM.admin textarea:focus {
        background: #ffd;
        color: black;
    }
    FORM.admin input[type="submit"]:hover {
        background: #ffd;
        color: #600;
    }
    FORM.admin input[type="submit"]:active {
        outline-color: red;
        color: red;
        background: #ffc;
    }
</style>

<form class="admin" action="/admin" enctype="multipart/form-data" method="post">
    <p>
        Type some text (if you like):
        <br/><input type="text" name="textline" size="30">
    </p>
    <br/>
    <p>
        Please specify a file, or a set of files:
        <br/><input type="file" name="datafile" size="40">
    </p>
    <div>
        <input type="submit" value="Send">
    </div>
</form>