<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        ._p-10 {
            padding: 10px;
        }

        .m-10 {
            margin: 10px;
        }
    </style>
</head>

<body>
    <p class="h1" style="text-align:center;margin: 30px;">Enter Your Details</p>
    <form action="/submit" id='form' method="post">
        <div class="container">
            <div class="row  mt-3 justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <div class=" input-group mb-3">
                        <input id="userId" name="name" type="text" class="_p-10 form-control" placeholder="Username" aria-label="Username">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8 ">
                    <div class="input-group mb-3">
                        <input type="number" class="_p-10  form-control" placeholder="Total Sales" aria-label="Total Sales">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <select class="form-select _p-10 mb-3" id="myCountry" onchange="handleCountryChange()" aria-label="Default select example">
                        <option selected>Countries</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <select class="form-select _p-10 mb-3" id="myState" onchange="handleStateChange()" aria-label="Default select example">
                        <option selected>States</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <select class="form-select _p-10 mb-3" id="myCity" onchange="handleCityChange()" aria-label="Default select example">
                        <option selected>Cities</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8 ">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Invoice</span>
                        <input type="file" accept="application/pdf" multiple class="form-control _p-10" placeholder="invoice">
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" accept="image/png" class="form-control _p-10" placeholder="your image">
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Invoice Date</span>
                        <input type="date" id="invoice_date" class="form-control _p-10" placeholder="invoice date">
                    </div>
                </div>
            </div>

        </div>
        <input type="submit" class="btn btn-primary" style="display: block;
        right: 0;
        margin-left: auto;
        margin-right: auto;" id="submit" value="submit">
    </form>
    <!-- <div id="demo"></div> -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const requestOptions = {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json"
                },
            }
            let select_country = document.getElementById("myCountry")
            fetch('/country', requestOptions).then(response => response.json()).then(data => {
                data.forEach(country => {
                    let myElm = document.createElement("option");
                    myElm.innerHTML = country.name
                    myElm.setAttribute("value", country.code);
                    select_country.appendChild(myElm);
                })
            })
        })


        function handleCountryChange() {
            var x = document.getElementById("myCountry").value;
            if (x == "Countries") {
                return
            }
            console.log(x)
            const requestOptions = {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json"
                },
            }
            // user has selected the country
            let select_state = document.getElementById("myState")
            while (select_state.hasChildNodes()) {
                select_state.removeChild(select_state.firstChild);
            }
            fetch('/state?country=' + x, requestOptions).then(response => response.json()).then(data => {
                data.states.forEach(state => {
                    let myElm = document.createElement("option");
                    myElm.innerHTML = state.District
                    myElm.setAttribute("value", state.District);
                    select_state.appendChild(myElm);
                })
            })
        }

        function handleStateChange() {
            var country_val = document.getElementById("myCountry").value;
            var state_val = document.getElementById("myState").value;
            console.log(state_val);
            if (state_val == "States") {
                return
            }
            const requestOptions = {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json"
                },
            }
            // user has selected the country
            let select_city = document.getElementById("myCity")
            while (select_city.hasChildNodes()) {
                select_city.removeChild(select_city.firstChild);
            }
            fetch('/city?country=' + country_val + "&state=" + state_val, requestOptions).then(response => response.json()).then(data => {
                data.cities.forEach(city => {
                    let myElm = document.createElement("option");
                    myElm.innerHTML = city.name
                    myElm.setAttribute("value", city.name);
                    select_city.appendChild(myElm);
                })
            })
        }

        function handleCityChange() {
            var x = document.getElementById("myCity").value;
            console.log(x)
        }
        form = document.getElementById("form")
        form.onsubmit = function(e) {
            e.preventDefault();
            uid = document.getElementById("userId").value;
            window.location.replace('/submit?name=' + uid);
        }
        window.onload = function() {
            var today = new Date().toISOString().split('T')[0];
            console.log(today)
            document.getElementById("invoice_date").setAttribute('max', today);
        }
    </script>

</body>

</html>