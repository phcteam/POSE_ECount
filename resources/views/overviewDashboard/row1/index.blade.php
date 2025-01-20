<div class="col-md-3">
    {{-- col 1 --}}
    <div class="card mb-2">

        <div class="card mb-2 card-gradient m-2 p-2">
            <h5>จำนวนบิลทั้งหมด</h5>
            <span class="d-inline">
                <strong>
                    <span class="h3" id="allbill-display"></span>
                </strong>
                บิล
            </span>
            <p>ภายในเดือน <span id="month-display"></span> </p>


        </div>


        <div class="chart-container">
            <canvas id="myDoughnutChart"></canvas>
            <i id="chart-icon"></i>


        </div>
        <div class="text-center mt-2 mb-2">
            <table class="w-75" style="margin: 0 auto;">
                <tr>
                    <td style="width: 10%; text-align: center;">
                        <span class="dot" style="background-color: #12B76A;"></span>
                    </td>
                    <td style="width: 70%; text-align: left;">
                        ยังไม่ได้ออกบิล (Waiting)
                    </td>
                    <th style="width: 20%; text-align: right;">
                        <span id="waiting-display"></span> บิล
                    </th>
                </tr>
                <tr>
                    <td style="width: 10%; text-align: center;">
                        <span class="dot" style="background-color: #36A2EB;"></span>
                    </td>
                    <td style="width: 70%; text-align: left;">
                        ยังไม่ได้ส่งบัญชี (Approving)
                    </td>
                    <th style="width: 20%; text-align: right;">
                        <span id="approving-display"></span> บิล
                    </th>
                </tr>
            </table>
        </div>
    </div>

    {{-- col 2 --}}

    <div class="card mb-2" style="height: 385px">
        <div class="card-header" style="height: 50px">
            <span class="d-inline">
                <strong>
                    <span class="circle-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                    </span>
                    <span class="h5">จำนวนบิลในเดือนนี้</span>
                </strong>
            </span>

        </div>
        <div class="m-1">

            <div style="height: 310px" class="mb-2">
                <div class="mt-2" style="height: 100%;"> <!-- ใช้ height: 100% เพื่อให้กราฟสูงเต็มที่ -->
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

@push('script')
    <script>
        function loadGraphData_row1col1(year, month) {
            $.ajax({
                url: `/get-row1col1-data/${year}/${month}`, // ส่งปีและเดือนไปที่ URL
                method: 'GET',
                success: function(data) {

                    $('#month-display').text(data.month_th);
                    $('#allbill-display').text(new Intl.NumberFormat().format(data.allBill));
                    $('#waiting-display').text(new Intl.NumberFormat().format(data.waiting));
                    $('#approving-display').text(new Intl.NumberFormat().format(data.approving));
                    $('#chart-icon').html(`<i class="fa-regular fa-clipboard chart-icon" style="font-size: 3rem;color:#000"></i>`);

                    const ctx = document.getElementById('myDoughnutChart').getContext('2d');
                    const chartData = {
                        labels: ['Approving', 'Waiting'], 
                        datasets: [{
                            data: [data.approving, data.waiting],  
                            backgroundColor: ['#36A2EB', '#12B76A'],  
                            hoverOffset: 4
                        }]
                    };

                    const config = {
                        type: 'doughnut',
                        data: chartData,
                        options: {
                            responsive: true,
                            layout: {
                                padding: {
                                    left: 20,
                                    right: 20,
                                    top: 20,
                                    bottom: 20
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 20,
                                        padding: 15,
                                        font: {
                                            size: 14,
                                        }
                                    }
                                }
                            },
                            cutout: '60%'
                        },
                        plugins: [{
                            id: 'textInsideWithCircle',
                            afterDraw: (chart) => {
                                const {
                                    ctx,
                                    chartArea
                                } = chart;
                                const {
                                    left,
                                    right,
                                    top,
                                    bottom
                                } = chartArea;
                                const radius = (right - left) / 2;
                                const centerX = (left + right) / 2;
                                const centerY = (top + bottom) / 2;
                                const values = chartData.datasets[0].data;
                                const colors = chartData.datasets[0].backgroundColor;

                                ctx.save();
                                ctx.font = 'bold 14px Arial';
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';

                                values.forEach((value, index) => {
                                    const angle = (chart.getDatasetMeta(0).data[index]
                                        .startAngle + chart.getDatasetMeta(0).data[
                                            index].endAngle) / 2;
                                    const x = centerX + (radius - 1) * Math.cos(angle);
                                    const y = centerY + (radius - 1) * Math.sin(angle);

                                    ctx.beginPath();
                                    ctx.arc(x, y, 20, 0, 2 * Math.PI);
                                    ctx.fillStyle = '#FFF';
                                    ctx.fill();

                                    ctx.strokeStyle = '#CCC';
                                    ctx.lineWidth = 2;
                                    ctx.stroke();

                                    ctx.fillStyle = colors[index];
                                    ctx.fillText(value, x, y);
                                });

                                ctx.restore();
                            }
                        }]
                    };

                    new Chart(ctx, config);
                }

            });
        }


        function loadGraphData_row1col2(year, month) {
            $.ajax({
                url: `/get-row1col2-data/${year}/${month}`, 
                method: 'GET',
                success: function(data) {
                    const ctx_line = document.getElementById('lineChart').getContext('2d');
                    const chart = new Chart(ctx_line, {
                        type: 'line',  
                        data: {
                            labels: data.days, 
                            datasets: [{
                                label: 'จำนวนบิล', 
                                data: data.saleOrders,
                                borderColor: 'rgba(75, 192, 192, 1)', 
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                                fill: true, 
                                tension: 0.1 
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,  
                            plugins: {
                                legend: {
                                    display: false, 
                                },
                                tooltip: {
                                    enabled: true,
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error loading line chart data:", error);
                    alert("ไม่สามารถโหลดข้อมูลกราฟได้");
                }
            });
        }



        loadGraphData_row1col1(year, month);
        loadGraphData_row1col2(year, month);
    </script>
@endpush
