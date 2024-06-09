<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .endpoint {
            margin-bottom: 20px;
        }
        .endpoint h2 {
            margin-top: 0;
        }
        .endpoint pre {
            background: #eee;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .icon {
            color: #007BFF;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>API Documentation</h1>
        <div class="endpoint">
            <h2><i class="fas fa-plug icon"></i>GET /api/crud/controlling</h2>
            <p>Retrieve a list of all controlling entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/controlling</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of controlling entries.</p>
            <pre>
        {
            "data": [
                {
                    "id": 1,
                    "date": "2024-06-09T12:00:00",
                    "duration": 30,
                    "status": "active",
                    "id_sub_device": 101
                },
                {
                    "id": 2,
                    "date": "2024-06-10T12:00:00",
                    "duration": 45,
                    "status": "inactive",
                    "id_sub_device": 102
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/controlling/:id</h2>
            <p>Retrieve information about a specific controlling entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/controlling/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the controlling entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the controlling entry.</p>
            <pre>
        {
            "data": {
                "id": 1,
                "date": "2024-06-09T12:00:00",
                "duration": 30,
                "status": "active",
                "id_sub_device": 101
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/controlling</h2>
            <p>Create a new controlling entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/controlling</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>date</td>
                        <td>datetime</td>
                        <td>The date and time of the controlling entry</td>
                    </tr>
                    <tr>
                        <td>duration</td>
                        <td>integer</td>
                        <td>The duration of the controlling entry in minutes</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>varchar</td>
                        <td>The status of the controlling entry</td>
                    </tr>
                    <tr>
                        <td>id_sub_device</td>
                        <td>integer</td>
                        <td>The ID of the sub-device associated with the controlling entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "date": "2024-06-11T12:00:00",
            "duration": 60,
            "status": "active",
            "id_sub_device": 103
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created controlling entry.</p>
            <pre>
        {
            "data": {
                "id": 3,
                "date": "2024-06-11T12:00:00",
                "duration": 60,
                "status": "active",
                "id_sub_device": 103
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-plug icon"></i>GET /api/crud/detailcontrolling</h2>
            <p>Retrieve a list of all detail controlling entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailcontrolling</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of detail controlling entries.</p>
            <pre>
        {
            "data": [
                {
                    "id_controlling": 1,
                    "temperature": 25,
                    "watt": 100
                },
                {
                    "id_controlling": 2,
                    "temperature": 22,
                    "watt": 90
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/detailcontrolling/:id</h2>
            <p>Retrieve information about a specific detail controlling entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailcontrolling/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the detail controlling entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the detail controlling entry.</p>
            <pre>
        {
            "data": {
                "id_controlling": 1,
                "temperature": 25,
                "watt": 100
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/detailcontrolling</h2>
            <p>Create a new detail controlling entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailcontrolling</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id_controlling</td>
                        <td>integer</td>
                        <td>The ID of the controlling entry</td>
                    </tr>
                    <tr>
                        <td>temperature</td>
                        <td>integer</td>
                        <td>The temperature value</td>
                    </tr>
                    <tr>
                        <td>watt</td>
                        <td>integer</td>
                        <td>The watt value</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "id_controlling": 3,
            "temperature": 28,
            "watt": 110
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created detail controlling entry.</p>
            <pre>
        {
            "data": {
                "id_controlling": 3,
                "temperature": 28,
                "watt": 110
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-tools icon"></i>GET /api/crud/detailmaintenance</h2>
            <p>Retrieve a list of all detail maintenance entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailmaintenance</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of detail maintenance entries.</p>
            <pre>
        {
            "data": [
                {
                    "id_maintenance": 1,
                    "detail": "Replaced filter",
                    "cost": 100
                },
                {
                    "id_maintenance": 2,
                    "detail": "Checked wiring",
                    "cost": 50
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/detailmaintenance/:id</h2>
            <p>Retrieve information about a specific detail maintenance entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailmaintenance/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the detail maintenance entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the detail maintenance entry.</p>
            <pre>
        {
            "data": {
                "id_maintenance": 1,
                "detail": "Replaced filter",
                "cost": 100
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/detailmaintenance</h2>
            <p>Create a new detail maintenance entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailmaintenance</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id_maintenance</td>
                        <td>integer</td>
                        <td>The ID of the maintenance entry</td>
                    </tr>
                    <tr>
                        <td>detail</td>
                        <td>string</td>
                        <td>The detail of the maintenance work</td>
                    </tr>
                    <tr>
                        <td>cost</td>
                        <td>integer</td>
                        <td>The cost of the maintenance work</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "id_maintenance": 3,
            "detail": "Lubricated bearings",
            "cost": 75
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created detail maintenance entry.</p>
            <pre>
        {
            "data": {
                "id_maintenance": 3,
                "detail": "Lubricated bearings",
                "cost": 75
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-plug icon"></i>GET /api/crud/detailroledevice</h2>
            <p>Retrieve a list of all detail role device entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailroledevice</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of detail role device entries.</p>
            <pre>
        {
            "data": [
                {
                    "id_role": 1,
                    "id_sub_device": 101,
                    "status": "active"
                },
                {
                    "id_role": 2,
                    "id_sub_device": 102,
                    "status": "inactive"
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/detailroledevice/:id</h2>
            <p>Retrieve information about a specific detail role device entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailroledevice/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the detail role device entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the detail role device entry.</p>
            <pre>
        {
            "data": {
                "id_role": 1,
                "id_sub_device": 101,
                "status": "active"
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/detailroledevice</h2>
            <p>Create a new detail role device entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/detailroledevice</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id_role</td>
                        <td>integer</td>
                        <td>The ID of the role</td>
                    </tr>
                    <tr>
                        <td>id_sub_device</td>
                        <td>integer</td>
                        <td>The ID of the sub-device associated with the role</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>varchar</td>
                        <td>The status of the role device entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "id_role": 3,
            "id_sub_device": 103,
            "status": "active"
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created detail role device entry.</p>
            <pre>
        {
            "data": {
                "id_role": 3,
                "id_sub_device": 103,
                "status": "active"
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-server icon"></i>GET /api/crud/devices</h2>
            <p>Retrieve a list of all device entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/devices</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of device entries.</p>
            <pre>
        {
            "data": [
                {
                    "id": 1,
                    "name": "Device 1",
                    "coordinate_device_x": "10.12345",
                    "coordinate_device_y": "20.12345",
                    "status": "active",
                    "condition": "good"
                },
                {
                    "id": 2,
                    "name": "Device 2",
                    "coordinate_device_x": "11.12345",
                    "coordinate_device_y": "21.12345",
                    "status": "inactive",
                    "condition": "maintenance"
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/devices/:id</h2>
            <p>Retrieve information about a specific device entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/devices/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the device entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the device entry.</p>
            <pre>
        {
            "data": {
                "id": 1,
                "name": "Device 1",
                "coordinate_device_x": "10.12345",
                "coordinate_device_y": "20.12345",
                "status": "active",
                "condition": "good"
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/devices</h2>
            <p>Create a new device entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/devices</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>string</td>
                        <td>The name of the device</td>
                    </tr>
                    <tr>
                        <td>coordinate_device_x</td>
                        <td>text</td>
                        <td>The X coordinate of the device</td>
                    </tr>
                    <tr>
                        <td>coordinate_device_y</td>
                        <td>text</td>
                        <td>The Y coordinate of the device</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>varchar</td>
                        <td>The status of the device</td>
                    </tr>
                    <tr>
                        <td>condition</td>
                        <td>string</td>
                        <td>The condition of the device</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "name": "Device 3",
            "coordinate_device_x": "12.12345",
            "coordinate_device_y": "22.12345",
            "status": "active",
            "condition": "new"
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created device entry.</p>
            <pre>
        {
            "data": {
                "id": 3,
                "name": "Device 3",
                "coordinate_device_x": "12.12345",
                "coordinate_device_y": "22.12345",
                "status": "active",
                "condition": "new"
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-tools icon"></i>GET /api/crud/maintenances</h2>
            <p>Retrieve a list of all maintenance entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/maintenances</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of maintenance entries.</p>
            <pre>
        {
            "data": [
                {
                    "id": 1,
                    "date": "2024-06-01T12:00:00",
                    "maintenance": "Filter replacement",
                    "id_user": 201,
                    "id_device": 301
                },
                {
                    "id": 2,
                    "date": "2024-06-05T12:00:00",
                    "maintenance": "Wiring check",
                    "id_user": 202,
                    "id_device": 302
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/maintenances/:id</h2>
            <p>Retrieve information about a specific maintenance entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/maintenances/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the maintenance entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the maintenance entry.</p>
            <pre>
        {
            "data": {
                "id": 1,
                "date": "2024-06-01T12:00:00",
                "maintenance": "Filter replacement",
                "id_user": 201,
                "id_device": 301
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/maintenances</h2>
            <p>Create a new maintenance entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/maintenances</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>date</td>
                        <td>datetime</td>
                        <td>The date and time of the maintenance entry</td>
                    </tr>
                    <tr>
                        <td>maintenance</td>
                        <td>varchar</td>
                        <td>The type of maintenance</td>
                    </tr>
                    <tr>
                        <td>id_user</td>
                        <td>integer</td>
                        <td>The ID of the user who performed the maintenance</td>
                    </tr>
                    <tr>
                        <td>id_device</td>
                        <td>integer</td>
                        <td>The ID of the device being maintained</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "date": "2024-06-11T12:00:00",
            "maintenance": "Lubrication",
            "id_user": 203,
            "id_device": 303
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created maintenance entry.</p>
            <pre>
        {
            "data": {
                "id": 3,
                "date": "2024-06-11T12:00:00",
                "maintenance": "Lubrication",
                "id_user": 203,
                "id_device": 303
            }
        }
            </pre>
        </div>

        <div class="endpoint">
            <h2><i class="fas fa-user-cog icon"></i>GET /api/crud/roledevice</h2>
            <p>Retrieve a list of all role device entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/roledevice</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of role device entries.</p>
            <pre>
        {
            "data": [
                {
                    "id": 1,
                    "id_device_master": 1,
                    "id_user": 201
                },
                {
                    "id": 2,
                    "id_device_master": 2,
                    "id_user": 202
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/roledevice/:id</h2>
            <p>Retrieve information about a specific role device entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/roledevice/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the role device entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the role device entry.</p>
            <pre>
        {
            "data": {
                "id": 1,
                "id_device_master": 1,
                "id_user": 201
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/roledevice</h2>
            <p>Create a new role device entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/roledevice</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id_device_master</td>
                        <td>integer</td>
                        <td>The ID of the master device</td>
                    </tr>
                    <tr>
                        <td>id_user</td>
                        <td>integer</td>
                        <td>The ID of the user associated with the role device</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "id_device_master": 3,
            "id_user": 203
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created role device entry.</p>
            <pre>
        {
            "data": {
                "id": 3,
                "id_device_master": 3,
                "id_user": 203
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-users icon"></i>GET /api/crud/users</h2>
            <p>Retrieve a list of all user entries.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/users</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Parameters:</strong> None</p>

            <h3>Response</h3>
            <p>The response will be a JSON object containing a list of user entries.</p>
            <pre>
        {
            "data": [
                {
                    "id": 1,
                    "name": "User 1",
                    "email": "user1@example.com",
                    "password": "hashed_password",
                    "level": 1
                },
                {
                    "id": 2,
                    "name": "User 2",
                    "email": "user2@example.com",
                    "password": "hashed_password",
                    "level": 2
                }
            ]
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-code icon"></i>GET /api/crud/users/:id</h2>
            <p>Retrieve information about a specific user entry by ID.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/users/:id</code></p>
            <p><strong>Method:</strong> GET</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>The ID of the user entry</td>
                    </tr>
                </tbody>
            </table>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the user entry.</p>
            <pre>
        {
            "data": {
                "id": 1,
                "name": "User 1",
                "email": "user1@example.com",
                "password": "hashed_password",
                "level": 1
            }
        }
            </pre>
        </div>
        <div class="endpoint">
            <h2><i class="fas fa-paper-plane icon"></i>POST /api/crud/users</h2>
            <p>Create a new user entry.</p>

            <h3>Request</h3>
            <p><strong>Endpoint:</strong> <code>/api/crud/users</code></p>
            <p><strong>Method:</strong> POST</p>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>varchar</td>
                        <td>The name of the user</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>varchar</td>
                        <td>The email address of the user</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td>varchar</td>
                        <td>The password for the user (hashed)</td>
                    </tr>
                    <tr>
                        <td>level</td>
                        <td>integer</td>
                        <td>The user level</td>
                    </tr>
                </tbody>
            </table>

            <h3>Example Request Body</h3>
            <pre>
        {
            "name": "User 3",
            "email": "user3@example.com",
            "password": "hashed_password",
            "level": 3
        }
            </pre>

            <h3>Response</h3>
            <p>The response will be a JSON object containing the details of the newly created user entry.</p>
            <pre>
        {
            "data": {
                "id": 3,
                "name": "User 3",
                "email": "user3@example.com",
                "password": "hashed_password",
                "level": 3
            }
        }
            </pre>
        </div>

    </div>
</body>
</html>
