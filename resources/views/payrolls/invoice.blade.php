<!DOCTYPE html>
<html>
<head>
    <title>Payroll PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Payroll for {{ $payroll->employee->name }}</h1>
    <table>
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $payroll->employee->name }}</td>
            </tr>
            <tr>
                <td>Position</td>
                <td>{{ $payroll->position }}</td>
            </tr>
            <tr>
                <td>Basic Salary</td>
                <td>{{ number_format($payroll->basic_salary, 2) }}</td>
            </tr>
            <tr>
                <td>Overtime Pay</td>
                <td>{{ number_format($payroll->overtime_pay, 2) }}</td>
            </tr>
            <tr>
                <td>Late Pay</td>
                <td>{{ number_format($payroll->late_pay, 2) }}</td>
            </tr>
            <tr>
                <td>Total Pay</td>
                <td>{{ number_format($payroll->total_pay, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
