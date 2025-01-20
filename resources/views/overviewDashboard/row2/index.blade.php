@push('style')
    <style>
        .row2 {
            height: 265px;
        }


        .customTable {
            width: 100%;
            /* border-collapse: collapse; */
            font-size: 10px;
        }

        .customTable thead {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            text-align: left;
        }


        .customTable tbody {
            display: block;
            max-height: 175px;
            overflow-y: auto;
            overflow: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .customTable tbody::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .customTable thead tr {
            display: table;
            width: 100%;
        }

        .customTable tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .status-bordered {
            border: 2px solid;
            padding: 2px 6px;
            font-size: 10px;
            border-radius: 25px;
            color: white;
            display: inline-block;
            text-align: center;
        }

        .status-bordered.active {
            background-color: #00B560;
            border-color: #00B560;
        }

        .status-bordered.inActive {
            background-color: #ff9102;
            border-color: #ff9102;
        }
    </style>
@endpush


<div class="col-md-3">
    {{-- col 1 --}}
    <div class="card mb-1 row2">
        <div class="card-header bg-primary">
            <h4 style="color: #fff">รายการผลิตวันนี้</h4>
        </div>
        <div class="mx-2 custom-scroll">
            <table id="row2col1_table" class="table customTable">
                <thead>
                    <tr>
                        <th>รายการผลิต</th>
                        <th style="width: 100px">Batch Size</th>
                        <th style="width: 100px">Lot.</th>
                        <th style="width: 100px;text-align: center">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ข้อมูลจะถูกเติมจาก JavaScript -->
                </tbody>
            </table>

        </div>

    </div>
    {{-- col 2 --}}
    <div class="card mb-1 row2">
        <div class="card-header bg-warning">
            <h4 style="color: #fff">รายการคงค้าง (ที่ไม่ใช่วันที่ปัจจุบัน)</h4>
        </div>
        <div class="mx-2">

            <table id="row2col2_table" class="table customTable">
                <thead>
                    <tr>
                        <th>รายการผลิต</th>
                        <th style="width: 100px">Batch Size</th>
                        <th style="width: 100px">Lot.</th>
                        <th style="width: 100px;text-align: center">วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ข้อมูลจะถูกเติมจาก JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    {{-- col 3 --}}
    <div class="card row2">
        <div class="card-header bg-success">
            <h4 style="color: #fff">รายการคงค้าง (ที่ไม่ใช่วันที่ปัจจุบัน)</h4>
        </div>
        <div class="mx-2">

            <table id="row2col3_table" class="table customTable">

                <thead>
                    <tr>
                        <th>รายการผลิต</th>
                        <th style="width: 100px">จำนวน</th>
                        <th style="width: 100px">Lot.</th>
                        <th style="width: 100px;text-align: center">สถานะ</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
</div>

@push('script')
    <script>
        function formatDateToThai(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear() + 543;

            return `${day}/${month}/${year}`;
        }

        function loadTableData_row2col1(year, month, day) {
            $.ajax({
                url: `/get-row2col1-data/${year}/${month}/${day}`,
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#row2col1_table tbody');
                    tableBody.empty(); // ลบข้อมูลเก่าในตาราง

                    if (!Array.isArray(data) || data.length === 0) {
                        tableBody.append('<tr><td colspan="4" style="text-align:center">ไม่มีข้อมูล</td></tr>');
                        return;
                    }

                    data.forEach(item => {
                        const statusColor = getStatusColor(item.status); // ฟังก์ชันแยก logic สี
                        const row = `
                    <tr>
                        <td>${item.Manufacturing_Name || '-'}</td>
                        <td style="width: 100px">${item.Manufacturing_Value || '-'} ${item.Manufacturing_Unit || ''}</td>
                        <td style="width: 100px">${item.Manufacturing_LotNo || '-'}</td>
                        <td style="width: 100px; text-align: center"><span class="${statusColor}">${item.status || '-'}</span></td>
                    </tr>
                `;
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error loading table data:", error);
                    alert("ไม่สามารถโหลดข้อมูลตารางได้");
                }
            });
        }

        function getStatusColor(status) {
            if (status === 'ผลิตเสร็จแล้ว') {
                return 'status-bordered active';
            }
            return 'status-bordered inActive';
        }



        function loadTableData_row2col2(year, month, day) {
            $.ajax({
                url: `/get-row2col2-data/${year}/${month}/${day}`,
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#row2col2_table tbody');
                    tableBody.empty();

                    if (!Array.isArray(data) || data.length === 0) {
                        tableBody.append('<tr><td colspan="4" style="text-align:center">ไม่มีข้อมูล</td></tr>');
                        return;
                    }


                    data.forEach(item => {

                        const formattedDate = formatDateToThai(item.DocDate);

                        const row = `
                    <tr>
                        <td>${item.Manufacturing_Name}</td>
                        <td style="width: 100px">${item.Manufacturing_Value} ${item.Manufacturing_Unit}</td>
                        <td style="width: 100px">${item.Manufacturing_LotNo}</td>
                        <td style="width: 100px;text-align: center">${formattedDate}</td>
                    </tr>
                `;
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error loading table data:", error);
                    alert("ไม่สามารถโหลดข้อมูลตารางได้");
                }
            });
        }

        function loadTableData_row2col3(year, month, day) {
            $.ajax({
                url: `/get-row2col3-data/${year}/${month}/${day}`,
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#row2col3_table tbody');
                    tableBody.empty();

                    if (!Array.isArray(data) || data.length === 0) {
                        tableBody.append('<tr><td colspan="4" style="text-align:center">ไม่มีข้อมูล</td></tr>');
                        return;
                    }

                    data.forEach(item => {
                        let statusColor = 'status-bordered inActive';
                        let IsApplieBefore_text = '';

                        if (item.IsApplieBefore == '0') {
                            IsApplieBefore_text = 'Completed';
                            statusColor = 'status-bordered active';
                        }

                        if (item.IsApplieBefore == '1') {
                            IsApplieBefore_text = 'Partial';
                            statusColor = 'status-bordered inActive';
                        }

                        const row = `
                    <tr>
                        <td>${item.NameTH}</td>
                        <td style="width: 100px">${item.Qty} ${item.Unit_Name}</td>
                        <td style="width: 100px">${item.LotNo}</td>
                        <td style="width: 100px;text-align: center"><span class="${statusColor}">${IsApplieBefore_text}</span></td>
                    </tr>
                `;
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error loading table data:", error);
                    alert("ไม่สามารถโหลดข้อมูลตารางได้");
                }
            });
        }

        loadTableData_row2col1(year, month, day);
        loadTableData_row2col2(year, month, day);
        loadTableData_row2col3(year, month, day);
    </script>
@endpush
