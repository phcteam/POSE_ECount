@extends('layouts.main')
@push('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-size: 11px;
        }

        .chart-container {
            position: relative;
            width: 250px;
            height: 250px;
            margin: 0 auto;
        }

        .chart-icon {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);

            color: #666;
        }


        .card-gradient {
            background: linear-gradient(45deg, #e9fcff, #ddffe5);
            border: none;

        }

        .card-gradient h5 {
            font-weight: 700;
        }

        .card-gradient .h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #36A2EB;

        }

        table .btn {
            font-size: 10px;
            border: none;
            border-radius: 20px 20px 20px 20px;
        }


        .circle-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #000;
            font-size: 1rem;
            border: 1px solid #666;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">


        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-3 mb-3">
                <div class="card mb-2">
                    <div class="card-header mb-2 card-gradient m-2">

                        <h5>จำนวนบิลทั้งหมด</h5>
                        <span class="d-inline">
                            <strong>
                                <span class="h3">1,000</span>
                            </strong>
                            บิล
                        </span>
                        <p>ภายในเดือน ธันวาคม </p>

                    </div>

                    <div class="chart-container">
                        <canvas id="myDoughnutChart"></canvas>
                        <i class="fa-regular fa-clipboard chart-icon" style="font-size: 3rem;color:#000"></i>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">การ์ด 2</h5>
                        <canvas id="horizontalBarChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">การ์ด 3</h5>
                        <p class="card-text">เนื้อหาการ์ดใบที่สาม</p>
                        <a href="#" class="btn btn-primary">ดูเพิ่มเติม</a>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">การ์ด 4</h5>
                        <p class="card-text">เนื้อหาการ์ดใบที่สี่</p>
                        <a href="#" class="btn btn-primary">ดูเพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('myDoughnutChart').getContext('2d');
        const data = {
            labels: ['Approving', 'Waiting'], // ใช้ label สำหรับ legend
            datasets: [{
                data: [700, 300],
                backgroundColor: ['#36A2EB', '#12B76A'], // สีกราฟ
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // แสดง legend
                        position: 'bottom', // ตำแหน่งอยู่ด้านล่าง
                        labels: {
                            boxWidth: 20, // ขนาดกล่องสี
                            padding: 15, // ระยะห่างระหว่างชื่อกับกล่องสี
                            font: {
                                size: 14, // ขนาดฟอนต์

                            }
                        }
                    }
                },
                cutout: '70%' // ขนาดรูตรงกลาง
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
                    const radius = (right - left) / 2; // รัศมีของวงกลม
                    const centerX = (left + right) / 2; // ตำแหน่ง x ของจุดศูนย์กลาง
                    const centerY = (top + bottom) / 2; // ตำแหน่ง y ของจุดศูนย์กลาง
                    const values = data.datasets[0].data; // ค่าในกราฟ
                    const colors = data.datasets[0].backgroundColor; // สีของกราฟแต่ละส่วน

                    ctx.save();
                    ctx.font = 'bold 14px Arial'; // ฟอนต์ของตัวเลข
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    values.forEach((value, index) => {
                        // คำนวณมุมและตำแหน่ง
                        const angle = (chart.getDatasetMeta(0).data[index].startAngle + chart
                            .getDatasetMeta(0).data[index].endAngle) / 2;
                        const x = centerX + (radius - 15) * Math.cos(angle); // ขยับเข้าในกราฟ
                        const y = centerY + (radius - 15) * Math.sin(angle); // ขยับเข้าในกราฟ

                        // วาดวงกลมพื้นหลัง
                        ctx.beginPath();
                        ctx.arc(x, y, 20, 0, 2 * Math.PI); // วาดวงกลม (radius = 20)
                        ctx.fillStyle = '#FFF'; // สีพื้นหลังวงกลม
                        ctx.fill();

                        // วาดเส้นขอบของวงกลม
                        ctx.strokeStyle = '#CCC'; // สีขอบ
                        ctx.lineWidth = 2;
                        ctx.stroke();

                        // วาดตัวเลขในวงกลม
                        ctx.fillStyle = colors[index]; // ใช้สีเดียวกับกราฟ
                        ctx.fillText(value, x, y);
                    });

                    ctx.restore();
                }
            }]
        };

        new Chart(ctx, config);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx_xline1 = document.getElementById('horizontalBarChart').getContext('2d');

            const data = {
                labels: ['กลุ่ม 1', 'กลุ่ม 2', 'กลุ่ม 3'], // ชื่อกลุ่มใหญ่
                datasets: [{
                        label: 'Yes',
                        data: [65, 75, 85],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'No',
                        data: [35, 25, 15],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            };

            const options = {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
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
                data: data,
                options: options
            });
        });
    </script>
@endsection
