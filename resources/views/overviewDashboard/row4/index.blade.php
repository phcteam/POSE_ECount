<div class="col-md-3">
    <div class="card mb-1 row2">
        <div class="m-2">
            <h4>ระยะเวลาดำเนินการ 1-3 วัน</h4>
            <p style="margin-top: -10px;">ภายในเดือน ธันวาคม</p>
            <div class="row">
                <div class="col">
                    <div class="chart-container">
                        {{-- <canvas id="doughnutChart1"></canvas>   --}}

                        <canvas id="doughnutChart1"></canvas>
                        <h5 class="chart-icon" style="font-size: 2rem;color:#000">76%</h5>

                    </div>
                </div>
                <div class="col">
                    s
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-1 row2">
        <div class="m-2">
            <h4>ระยะเวลาดำเนินการ 4-6 วัน</h4>
            <p style="margin-top: -10px;">ภายในเดือน ธันวาคม</p>

            <div class="row">
                <div class="col">
                    <div class="chart-container">
                        <canvas id="doughnutChart2"></canvas>
                        <h5 class="chart-icon" style="font-size: 2rem;color:#000">53%</h5>


                    </div>
                </div>
                <div class="col">
                    s
                </div>
            </div>



        </div>
    </div>
    <div class="card row2">
        <div class="m-2">
            <h4>ระยะเวลาดำเนินการ 7 วันขึ้นไป</h4>
            <p style="margin-top: -10px;">ภายในเดือน ธันวาคม</p>

            <div class="row">
                <div class="col">
                    <div class="chart-container">
                        <canvas id="doughnutChart3"></canvas>
                        <h5 class="chart-icon" style="font-size: 2rem;color:#000">11%</h5>


                    </div>
                </div>
                <div class="col">
                    s
                </div>
            </div>

        </div>
    </div>
</div>
@push('script')

<script></script>
    
@endpush
{{-- @push('script')
    <script>
        const doughnutChartData1 = {
            labels: ['จัดส่งแล้ว', 'ยังไม่ได้จัดส่ง'],
            datasets: [{
                data: [500, 100],
                backgroundColor: ['#36A2EB', '#FF5733'],
                hoverOffset: 4,
                borderWidth: 1 // เพิ่มความหนาของขอบกราฟ
            }]
        };

        const doughnutChartData2 = {
            labels: ['จัดส่งแล้ว', 'ยังไม่ได้จัดส่ง'],
            datasets: [{
                data: [300, 200],
                backgroundColor: ['#FF914D', '#12B76A'],
                hoverOffset: 4,
                borderWidth: 1 // เพิ่มความหนาของขอบกราฟ
            }]
        };

        const doughnutChartData3 = {
            labels: ['จัดส่งแล้ว', 'ยังไม่ได้จัดส่ง'],
            datasets: [{
                data: [150, 50],
                backgroundColor: ['#F79009', '#FFC300'],
                hoverOffset: 4,
                borderWidth: 1 // เพิ่มความหนาของขอบกราฟ
            }]
        };


        const createDoughnutChart = (canvasId, data) => {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // ไม่ให้กราฟมีอัตราส่วนคงที่
                    layout: {
                        padding: {
                            left: 20, // เพิ่มระยะห่างจากขอบซ้าย
                            right: 20, // เพิ่มระยะห่างจากขอบขวา
                            top: 20, // ระยะห่างจากขอบบน
                            bottom: 20 // ระยะห่างจากขอบล่าง
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
                                    size: 14
                                }
                            }
                        }
                    },
                    cutout: '60%' // ขนาดรูตรงกลาง
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
                        const values = data.datasets[0].data;
                        const colors = data.datasets[0].backgroundColor;

                        ctx.save();
                        ctx.font = 'bold 14px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        values.forEach((value, index) => {
                            const angle = (chart.getDatasetMeta(0).data[index].startAngle +
                                chart
                                .getDatasetMeta(0).data[index].endAngle) / 2;
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
        };

        // สร้างกราฟวงกลม 3 ตัว
        createDoughnutChart('doughnutChart1', doughnutChartData1);
        createDoughnutChart('doughnutChart2', doughnutChartData2);
        createDoughnutChart('doughnutChart3', doughnutChartData3);
    </script>
@endpush --}}
