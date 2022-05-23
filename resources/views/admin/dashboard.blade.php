<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
        
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->

    <link rel="stylesheet" href="{{url('/css/adminDash.css')}}">
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/lineicons.css')}}">
    <link rel="stylesheet" href="{{url('/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{url('/css/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{url('/css/main.css')}}">
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.adminNav')
    </div>

    <div>
        <div class="panel">
            <div class="board1">
                <div class="row">
                    <div class="col-sm-2 pad1">
                      <div class="data">
                        {{$totalContestant}}
                      </div>
                        <div class="no">
                            Total Contestants
                        </div>
                    </div>
                    <div class="col-sm-2 pad2">
                      <div class="data">
                        {{$totalVotes}}
                      </div>
                      <div class="no">
                        Total votes
                      </div>
                      <div class="data">
                        0
                      </div> 
                      <div class="no">
                        Highest Votes
                      </div>   
                    </div>
                    <div class="col-sm-2 pad4">
                      <div class="data">
                        ${{$totalPayment}}
                       </div> 
                      <div class="no">
                        Total payments received
                      </div>
                    </div>
                    <div class="col-sm-2 pad3">
                      <div class="data">
                        {{$totalAdmin}}
                      </div>
                      <div class="no">
                        Total Admins
                      </div>
                    </div>
                </div>
            </div>
            <div class="board2">
                <div class="row">
                    <div class="col-lg-7">
                      <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-10">Yearly subscription</h6>
                                <h3 class="text-bold">${{$totalPayment}}</h3>
                            </div>
                            <div class="right">
                                <div class="select-style-1">
                                    <div class="select-position select-sm">
                                        <select class="light-bg">
                                            <option value="">Yearly</option>
                                            <option value="">Monthly</option>
                                            <option value="">Weekly</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end select -->
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                          <canvas
                            id="Chart1"
                            style="width: 100%; height: 400px"
                          ></canvas>
                        </div>
                        <!-- End Chart -->
                    </div>
                    </div>
                    <!-- End Col -->
                        <div class="col-lg-5">
                            <div class="card-style mb-30">
                                <div
                                class="
                                    title
                                    d-flex
                                    flex-wrap
                                    align-items-center
                                    justify-content-between
                                "
                                >
                                    <div class="left">
                                        <h6 class="text-medium mb-30">Sales/Revenue</h6>
                                    </div>
                                    <div class="right">
                                        <div class="select-style-1">
                                            <div class="select-position select-sm">
                                                <select class="light-bg">
                                                    <option value="">Yearly</option>
                                                    <option value="">Monthly</option>
                                                    <option value="">Weekly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- end select -->
                                    </div>
                                </div>
                                <!-- End Title -->
                                <div class="chart">
                                    <canvas
                                        id="Chart2"
                                        style="width: 100%; height: 400px"
                                    ></canvas>
                                </div>
                                <!-- End Chart -->
                            </div>
                        </div>
                        <!-- End Col -->
                </div>

                <div class="row">
                    <div class="col-lg-7">
                      <div class="card-style mb-30">
                        <div
                          class="
                            title
                            d-flex
                            flex-wrap
                            align-items-center
                            justify-content-between
                          "
                        >
                          <div class="left">
                            <h6 class="text-medium mb-2">Sales Forecast</h6>
                          </div>
                          <div class="right">
                            <div class="select-style-1 mb-2">
                              <div class="select-position select-sm">
                                <select class="light-bg">
                                  <option value="">Last Month</option>
                                  <option value="">Last 3 Months</option>
                                  <option value="">Last Year</option>
                                </select>
                              </div>
                            </div>
                            <!-- end select -->
                          </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                          <div id="legend3">
                            <ul
                              class="legend3 d-flex flex-wrap align-items-center mb-30"
                            >
                              <li>
                                <div class="d-flex">
                                  <span class="bg-color primary-bg"> </span>
                                  <div class="text">
                                    <p class="text-sm text-success">
                                      <span class="text-dark">Revenue</span> +25.55%
                                      <i class="lni lni-arrow-up"></i>
                                    </p>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="d-flex">
                                  <span class="bg-color purple-bg"></span>
                                  <div class="text">
                                    <p class="text-sm text-success">
                                      <span class="text-dark">Net Profit</span> +45.55%
                                      <i class="lni lni-arrow-up"></i>
                                    </p>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="d-flex">
                                  <span class="bg-color orange-bg"></span>
                                  <div class="text">
                                    <p class="text-sm text-danger">
                                      <span class="text-dark">Order</span> -4.2%
                                      <i class="lni lni-arrow-down"></i>
                                    </p>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <canvas
                            id="Chart3"
                            style="width: 100%; height: 450px"
                          ></canvas>
                        </div>
                      </div>
                    </div>
                    <!-- End Col -->
                    <div class="col-lg-5">
                      <div class="card-style mb-30">
                        <div
                          class="
                            title
                            d-flex
                            flex-wrap
                            align-items-center
                            justify-content-between
                          "
                        >
                          <div class="left">
                            <h6 class="text-medium mb-2">Traffic</h6>
                          </div>
                          <div class="right">
                            <div class="select-style-1 mb-2">
                              <div class="select-position select-sm">
                                <select class="bg-ligh">
                                  <option value="">Last 6 Months</option>
                                  <option value="">Last 3 Months</option>
                                  <option value="">Last Year</option>
                                </select>
                              </div>
                            </div>
                            <!-- end select -->
                          </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                          <div id="legend4">
                            <ul
                              class="legend3 d-flex flex-wrap align-items-center mb-30"
                            >
                              <li>
                                <div class="d-flex">
                                  <span class="bg-color primary-bg"> </span>
                                  <div class="text">
                                    <p class="text-sm text-success">
                                      <span class="text-dark">Store Visits</span>
                                      +25.55%
                                      <i class="lni lni-arrow-up"></i>
                                    </p>
                                    <h2>3456</h2>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="d-flex">
                                  <span class="bg-color danger-bg"></span>
                                  <div class="text">
                                    <p class="text-sm text-danger">
                                      <span class="text-dark">Visitors</span> -2.05%
                                      <i class="lni lni-arrow-down"></i>
                                    </p>
                                    <h2>3456</h2>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <canvas
                            id="Chart4"
                            style="width: 100%; height: 420px"
                          ></canvas>
                        </div>
                        <!-- End Chart -->
                      </div>
                    </div>
                    <!-- End Col -->
                </div>

                <div class="row d-flex justify-content-between">
                    <div class="col-lg-5">
                        <div class="card-style mb-30">
                          <div
                            class="
                              title
                              d-flex
                              justify-content-between
                              align-items-center
                            "
                          >
                            <div class="left">
                              <h6 class="text-medium mb-30">Votes by State</h6>
                            </div>
                          </div>
                          <!-- End Title -->
                          <div id="map" style="width: 100%; height: 360px"></div>
                          <p>Last updated: 7 days ago</p>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-lg-5">
                        <div class="card-style calendar-card mb-30">
                            <div id="calendar-mini"></div>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{url('/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/js/Chart.min.js')}}"></script>
    <script src="{{url('/js/dynamic-pie-chart.js')}}"></script>
    <script src="{{url('/js/moment.min.js')}}"></script>
    <script src="{{url('/js/fullcalendar.js')}}"></script>
    <script src="{{url('/js/jvectormap.min.js')}}"></script>
    <script src="{{url('/js/world-merc.js')}}"></script>
    <script src="{{url('/js/polyfill.js')}}"></script>
    <script src="{{url('/js/main.js')}}"></script>
    <script>
        // =========== chart one start
      const ctx1 = document.getElementById("Chart1").getContext("2d");
      const chart1 = new Chart(ctx1, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [
            {
              label: "",
              backgroundColor: "transparent",
              borderColor: "#4A6CF7",
              data: [
                600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
              ],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#4A6CF7",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 5,
              pointBorderWidth: 5,
              pointRadius: 8,
              pointHoverRadius: 8,
            },
          ],
        },

        // Configuration options
        defaultFontFamily: "Inter",
        options: {
          tooltips: {
            callbacks: {
              labelColor: function (tooltipItem, chart) {
                return {
                  backgroundColor: "#ffffff",
                };
              },
            },
            intersect: false,
            backgroundColor: "#f9f9f9",
            titleFontFamily: "Inter",
            titleFontColor: "#8F92A1",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  padding: 35,
                  max: 1200,
                  min: 500,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            ],
          },
        },
      });

      // =========== chart one end

      // =========== chart two start
      const ctx2 = document.getElementById("Chart2").getContext("2d");
      const chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [
            {
              label: "",
              backgroundColor: "#4A6CF7",
              barThickness: 6,
              maxBarThickness: 8,
              data: [
                600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
              ],
            },
          ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            callbacks: {
              labelColor: function (tooltipItem, chart) {
                return {
                  backgroundColor: "rgba(104, 110, 255, .0)",
                };
              },
            },
            backgroundColor: "#F3F6F8",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  padding: 35,
                  max: 1200,
                  min: 0,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            ],
          },
        },
      });
      // =========== chart two end

    //  MAP
    
    // ======== jvectormap activation
    var markers = [
        { name: "Egypt", coords: [26.8206, 30.8025] },
        { name: "Russia", coords: [61.524, 105.3188] },
        { name: "Canada", coords: [56.1304, -106.3468] },
        { name: "Greenland", coords: [71.7069, -42.6043] },
        { name: "Brazil", coords: [-14.235, -51.9253] },
      ];

      var jvm = new jsVectorMap({
        map: "world_merc",
        selector: "#map",
        zoomButtons: true,

        regionStyle: {
          initial: {
            fill: "#d1d5db",
          },
        },

        labels: {
          markers: {
            render: (marker) => marker.name,
          },
        },

        markersSelectable: true,
        selectedMarkers: markers.map((marker, index) => {
          var name = marker.name;

          if (name === "Russia" || name === "Brazil") {
            return index;
          }
        }),
        markers: markers,
        markerStyle: {
          initial: { fill: "#4A6CF7" },
          selected: { fill: "#ff5050" },
        },
        markerLabelStyle: {
          initial: {
            fontWeight: 400,
            fontSize: 14,
          },
        },
      });

      // ====== calendar activation
      document.addEventListener("DOMContentLoaded", function () {
        var calendarMiniEl = document.getElementById("calendar-mini");
        var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
          initialView: "dayGridMonth",
          headerToolbar: {
            end: "today prev,next",
          },
        });
        calendarMini.render();
      });

      // =========== chart three start
      const ctx3 = document.getElementById("Chart3").getContext("2d");
      const chart3 = new Chart(ctx3, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          // Information about the dataset
          datasets: [
            {
              label: "Revenue",
              backgroundColor: "transparent",
              borderColor: "#4a6cf7",
              data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#4a6cf7",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
            {
              label: "Profit",
              backgroundColor: "transparent",
              borderColor: "#9b51e0",
              data: [
                120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
              ],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#9b51e0",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
            {
              label: "Order",
              backgroundColor: "transparent",
              borderColor: "#f2994a",
              data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#f2994a",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
            },
          ],
        },

        // Configuration options
        options: {
          tooltips: {
            intersect: false,
            backgroundColor: "#fbfbfb",
            titleFontColor: "#8F92A1",
            titleFontSize: 16,
            titleFontFamily: "Inter",
            titleFontStyle: "400",
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 15,
            borderColor: "rgba(143, 146, 161, .1)",
            borderWidth: 1,
            title: false,
          },

          title: {
            display: false,
          },

          layout: {
            padding: {
              top: 0,
            },
          },

          legend: false,

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  padding: 35,
                  max: 300,
                  min: 50,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            ],
          },
        },
      });
      // =========== chart three end

      // ================== chart four start
      const ctx4 = document.getElementById("Chart4").getContext("2d");
      const chart4 = new Chart(ctx4, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
          // Information about the dataset
          datasets: [
            {
              label: "",
              backgroundColor: "#4A6CF7",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [600, 700, 1000, 700, 650, 800],
            },
            {
              label: "",
              backgroundColor: "#d50100",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [690, 740, 720, 1120, 876, 900],
            },
          ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            callbacks: {
              labelColor: function (tooltipItem, chart) {
                return {
                  backgroundColor: "rgba(104, 110, 255, .0)",
                };
              },
            },
            backgroundColor: "#F3F6F8",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  padding: 35,
                  max: 1200,
                  min: 0,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            ],
          },
        },
      });
      // =========== chart four end


    </script>
</body>
</html>