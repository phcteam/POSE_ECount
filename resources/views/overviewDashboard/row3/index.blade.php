@push('style')
    <style>
        .row3 {
            height: 400px;
        }

        .row3custom-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            height: 140px;

        }

        .row3custom-table thead td {
            border-bottom: 2px solid #6e6e6e;
            text-align: left;
        }

        .row3custom-table thead td.not-delivered {
            border-bottom: 2px solid #F79009;
            text-align: center;
            color: #F79009;
            width: 20%;
        }

        .row3custom-table thead td.delivered {
            border-bottom: 2px solid #12B76A;
            text-align: center;
            color: #12B76A;
            width: 20%;

        }

        .row3custom-table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .row3custom-table td {
            padding: 2px 5px;
            text-align: left;
        }

        .dot-label {
            display: flex;
            align-items: center;
            font-size: 11px;
        }

        .dot-label::before {
            content: '';
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;


        }

        .dot-label.delivered::before {
            background-color: #12B76A;
        }

        .dot-label.not-delivered::before {
            background-color: #F79009;
        }
    </style>
@endpush

<div class="col-md-3">
    <div class="card mb-1 row3">
        <div class="card-header" style="height: 50px">
            <span class="d-inline">
                <strong>
                    <span class="circle-icon">
                        <i class="fa-regular fa-clipboard"></i>
                    </span>
                    <span class="h5">สรุปบิลวันนี้</span>
                </strong>
            </span>

        </div>
        <div class="m-1">
            <div style="height: 170px;">
                <canvas id="horizontalBarChart"></canvas>
            </div>
            <div id="row3col1_label" class="text-center d-flex justify-content-center align-items-center my-2">
                <!-- ข้อความจะแสดงที่นี่ -->
            </div>

            <table id='row3col1_table' class="row3custom-table">
                {{-- <table class="row3custom-table"> --}}

                <thead>
                    <tr>
                        <td>พื้นที่</td>
                        <td class="delivered">จัดส่งแล้ว</td>
                        <td class="not-delivered">ยังไม่ได้จัดส่ง</td>
                        <td style="text-align: center;width: 20%;">รวม</td>
                    </tr>
                </thead>
                <tbody></tbody>


            </table>
        </div>
    </div>
    <div class="card row3">
        <div class="card-header" style="height: 50px">
            <span class="d-inline">
                <strong>
                    <span class="circle-icon">
                        <i class="fa-regular fa-clipboard"></i>
                    </span>
                    <span class="h5">สรุปบิลเดือนนี้</span>
                </strong>
            </span>

        </div>
        <div class="m-1">
            <div style="height: 170px;">
                <canvas id="horizontalBarChart_row3col2"></canvas>
            </div>
            <div id="row3col2_label" class="text-center d-flex justify-content-center align-items-center my-2">
                <!-- ข้อความจะแสดงที่นี่ -->
            </div>

            <table id='row3col2_table' class="row3custom-table">
                {{-- <table class="row3custom-table"> --}}

                <thead>
                    <tr>
                        <td>พื้นที่</td>
                        <td class="delivered">จัดส่งแล้ว</td>
                        <td class="not-delivered">ยังไม่ได้จัดส่ง</td>
                        <td style="text-align: center;width: 20%;">รวม</td>
                    </tr>
                </thead>
                <tbody></tbody>


            </table>
        </div>
    </div>
</div>
@push('script')
    <script>
        function loadGraphData_row3col1(year, month, day) {
            $.ajax({
                url: `/get-row3col1-data/${year}/${month}/${day}`,
                method: 'GET',
                success: function(data) {

                    const labels = Object.keys(data);
                    const deliveredData = labels.map(key => data[key]["delivered"]);
                    const notDeliveredData = labels.map(key => data[key]["not_delivery"]);
                    const ctx_xline1 = document.getElementById('horizontalBarChart').getContext('2d');

                    const chartData = {
                        labels: labels,
                        datasets: [{
                                label: 'จัดส่งแล้ว',
                                data: deliveredData,
                                backgroundColor: '#12B76A',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'ยังไม่ได้จัดส่ง',
                                data: notDeliveredData,
                                backgroundColor: '#F79009',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    const chartOptions = {
                        indexAxis: 'y', // กราฟแท่งแนวนอน
                        responsive: true,
                        maintainAspectRatio: false, // เปิดให้กราฟขยายได้ตามขนาดของ container
                        plugins: {
                            legend: {
                                display: false, // ปิดการแสดง legend
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                            },
                            y: {
                                beginAtZero: true,
                            }
                        }
                    };


                    new Chart(ctx_xline1, {
                        type: 'bar',
                        data: chartData,
                        options: chartOptions
                    });

                    const row3col1_label = $('#row3col1_label');
                    row3col1_label.empty();
                    const row = `
                        <span class="dot-label delivered mx-2">จัดส่งแล้ว</span>
                        <span class="dot-label not-delivered mx-2">ยังไม่ได้จัดส่ง</span>
                    `;
                    row3col1_label.append(row);


                    const row3col1_table = $('#row3col1_table tbody'); // เลือกเฉพาะ tbody
                    row3col1_table.empty(); // ลบเฉพาะข้อมูลใน tbody

                    let totalDelivered = 0;
                    let totalNotDelivered = 0;

                    // Loop เพื่อสร้างแถวข้อมูลจาก API
                    Object.keys(data).forEach(area => {
                        const delivered = data[area].delivered;
                        const notDelivered = data[area].not_delivery;

                        totalDelivered += delivered;
                        totalNotDelivered += notDelivered;


                        const tableRow = `
                                <tr>
                                    <td>${area}</td>
                                    <th style="color: #12B76A;text-align: center;width: 20%">${delivered.toLocaleString()}</th>
                                    <th style="color: #F79009;text-align: center;width: 20%">${notDelivered.toLocaleString()}</th>
                                    <td style="background-color: #f9fafb;text-align: center;width: 20%">${(delivered + notDelivered).toLocaleString()}</td>
                                </tr>
                            `;
                        row3col1_table.append(tableRow);
                    });

                    // สร้างแถวรวม
                    const totalRow = `
                                <tr style="background-color: #eaecf0">
                                    <th style="font-size: 12px;">รวม</th>
                                    <th style="color: #12B76A;text-align: center;width: 20%;font-size: 12px;">${totalDelivered.toLocaleString()}</th>
                                    <th style="color: #F79009;text-align: center;width: 20%;font-size: 12px;">${totalNotDelivered.toLocaleString()}</th>
                                    <th style="text-align: center;width: 20%;font-size: 12px;">${(totalDelivered + totalNotDelivered).toLocaleString()}</th>
                                </tr>
                            `;
                    row3col1_table.append(totalRow);

                },
                error: function(xhr, status, error) {
                    console.error("Error loading graph data:", error);
                    alert("ไม่สามารถโหลดข้อมูลกราฟได้");
                }
            });
        }

        loadGraphData_row3col1(year, month, day);


        function loadGraphData_row3col2(year, month, day) {
            $.ajax({
                url: `/get-row3col2-data/${year}/${month}`,
                method: 'GET',
                success: function(data) {

                    const labels = Object.keys(data);
                    const deliveredData = labels.map(key => data[key]["delivered"]);
                    const notDeliveredData = labels.map(key => data[key]["not_delivery"]);
                    const ctx_xline2 = document.getElementById('horizontalBarChart_row3col2').getContext('2d');

                    const chartData = {
                        labels: labels,
                        datasets: [{
                                label: 'จัดส่งแล้ว',
                                data: deliveredData,
                                backgroundColor: '#12B76A',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'ยังไม่ได้จัดส่ง',
                                data: notDeliveredData,
                                backgroundColor: '#F79009',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    const chartOptions = {
                        indexAxis: 'y', // กราฟแท่งแนวนอน
                        responsive: true,
                        maintainAspectRatio: false, // เปิดให้กราฟขยายได้ตามขนาดของ container
                        plugins: {
                            legend: {
                                display: false, // ปิดการแสดง legend
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                            },
                            y: {
                                beginAtZero: true,
                            }
                        }
                    };


                    new Chart(ctx_xline2, {
                        type: 'bar',
                        data: chartData,
                        options: chartOptions
                    });

                    const row3col1_label = $('#row3col2_label');
                    row3col1_label.empty();
                    const row = `
                        <span class="dot-label delivered mx-2">จัดส่งแล้ว</span>
                        <span class="dot-label not-delivered mx-2">ยังไม่ได้จัดส่ง</span>
                    `;
                    row3col1_label.append(row);


                    const row3col1_table = $('#row3col2_table tbody'); // เลือกเฉพาะ tbody
                    row3col1_table.empty(); // ลบเฉพาะข้อมูลใน tbody

                    let totalDelivered = 0;
                    let totalNotDelivered = 0;

                    // Loop เพื่อสร้างแถวข้อมูลจาก API
                    Object.keys(data).forEach(area => {
                        const delivered = data[area].delivered;
                        const notDelivered = data[area].not_delivery;

                        totalDelivered += delivered;
                        totalNotDelivered += notDelivered;

                        const tableRow = `
                                <tr>
                                    <td>${area}</td>
                                    <th style="color: #12B76A;text-align: center;width: 20%">${delivered.toLocaleString()}</th>
                                    <th style="color: #F79009;text-align: center;width: 20%">${notDelivered.toLocaleString()}</th>
                                    <td style="background-color: #f9fafb;text-align: center;width: 20%">${(delivered + notDelivered).toLocaleString()}</td>
                                </tr>
                            `;
                        row3col1_table.append(tableRow);
                    });

                
                    const totalRow = `
                                <tr style="background-color: #eaecf0">
                                    <th style="font-size: 12px;">รวม</th>
                                    <th style="color: #12B76A;text-align: center;width: 20%;font-size: 12px;">${totalDelivered.toLocaleString()}</th>
                                    <th style="color: #F79009;text-align: center;width: 20%;font-size: 12px;">${totalNotDelivered.toLocaleString()}</th>
                                    <th style="text-align: center;width: 20%;font-size: 12px;">${(totalDelivered + totalNotDelivered).toLocaleString()}</th>
                                </tr>
                            `;
                    row3col1_table.append(totalRow);

                },
                error: function(xhr, status, error) {
                    console.error("Error loading graph data:", error);
                    alert("ไม่สามารถโหลดข้อมูลกราฟได้");
                }
            });
        }
        loadGraphData_row3col2(year, month, day);
    </script>
@endpush
