/**
 * @author Adam Milton-Barker <adammiltonbarker@gmail.com>
 */

var iotJumpWayWebSoc = {
    client: null,
    connected: false,
    host: "iot.techbubbletechnologies.com",
    port: 9001,
    useTLS: true,
    cleansession: true,
    mqttOptions: {
        locationID: 84,
        applicationID: 69,
        applicationName: "GeniSysAIWebSockets",
        userName: "Mkr1PlJGI0di",
        passwd: "Rdaoasj@Ln0qakim9jd@"
    },
    connect: function() {
        var reconnectTimeout = 2000;
        this.thisLocationID = iotJumpWayWebSoc.mqttOptions.locationID;

        this.client = new Paho.MQTT.Client(
            this.host,
            this.port,
            iotJumpWayWebSoc.mqttOptions.applicationName
        );

        var lwt = new Paho.MQTT.Message("OFFLINE");
        lwt.destinationName =
            iotJumpWayWebSoc.mqttOptions.locationID +
            "/Applications/" +
            iotJumpWayWebSoc.mqttOptions.applicationID +
            "/Status";
        lwt.qos = 0;
        lwt.retained = false;

        this.client.onConnectionLost = this.onConnectionLost;
        this.client.onMessageArrived = this.onMessageArrived;

        this.client.connect({
            userName: iotJumpWayWebSoc.mqttOptions.userName,
            password: iotJumpWayWebSoc.mqttOptions.passwd,
            timeout: 10,
            useSSL: this.useTLS,
            cleanSession: this.cleansession,
            onSuccess: this.onConnect,
            onFailure: this.onFail,
            willMessage: lwt
        });
    },
    onConnect: function() {
        this.connected = true;
        $("#status").prepend(
            "<p><strong>Connected to iotJumpWay WebSocket Broker</strong><br />" +
            new Date($.now()) +
            "</p>"
        );
        iotJumpWayWebSoc.publishToApplicationStatus();
        iotJumpWayWebSoc.subscribeToAll({
            locationID: iotJumpWayWebSoc.mqttOptions.locationID
        });
    },
    onFail: function(message) {
        this.connected = false;
        $("#status").prepend(
            "<p><strong>iotJumpWay connection failed:</strong><br />" +
            message.errorMessage +
            "<br />" +
            new Date($.now()) +
            "</p>"
        );
    },
    onConnectionLost: function(responseObject) {
        this.connected = false;
        if (responseObject.errorCode !== 0) {
            $("#status").prepend(
                "<p><strong>iotJumpWay connection lost:</strong><br />" +
                responseObject.errorMessage +
                "<br />" +
                new Date($.now()) +
                "</p>"
            );
        }
    },
    onMessageArrived: function(message) {
        var messageObj = {
            topic: message.destinationName,
            retained: message.retained,
            qos: message.qos,
            payload: message.payloadString,
            timestamp: moment()
        };
        $("#status").prepend(
            "<p><strong>iotJumpWay communication on " +
            message.destinationName +
            ":</strong><br />" +
            message.payloadString +
            " with QoS: " +
            message.qos +
            "<br />" +
            new Date($.now()) +
            "</p>"
        );
    },
    disconnect: function() {
        this.client.disconnect();
        $("#status").prepend(
            "<p><strong>Disconnected from iotJumpWay</strong><br />" +
            new Date($.now()) +
            "</p>"
        );
    },
    subscribeToAll: function() {
        this.client.subscribe(
            iotJumpWayWebSoc.mqttOptions.locationID + "/Devices/#", { qos: 0 }
        );
        this.client.subscribe(
            iotJumpWayWebSoc.mqttOptions.locationID + "/Applications/#", { qos: 0 }
        );
        $("#status").prepend(
            "<p>Subscribed to: " +
            iotJumpWayWebSoc.mqttOptions.locationID +
            "/Devices/#<br />" +
            new Date($.now()) +
            "</p>"
        );
    },
    publishToApplicationStatus: function() {
        message = new Paho.MQTT.Message("ONLINE");
        message.destinationName =
            iotJumpWayWebSoc.mqttOptions.locationID +
            "/Applications/" +
            iotJumpWayWebSoc.mqttOptions.applicationID +
            "/Status";
        this.client.send(message);
        $("#status").prepend(
            "<p>Published to: " +
            iotJumpWayWebSoc.mqttOptions.locationID +
            "/Applications/" +
            iotJumpWayWebSoc.mqttOptions.applicationID +
            "/Status<br />" +
            new Date($.now()) +
            "</p>"
        );
        console.log(
            "Published to: " +
            iotJumpWayWebSoc.mqttOptions.locationID +
            "/Applications/" +
            iotJumpWayWebSoc.mqttOptions.applicationID +
            "/Status"
        );
    },
    publishToDeviceCommands: function(params) {
        message = new Paho.MQTT.Message(params.message);
        message.destinationName =
            params.locationID +
            "/Devices/" +
            params.zoneID +
            "/" +
            params.deviceID +
            "/Commands";
        this.client.send(message);
        $("#status").prepend(
            "<p>" +
            new Date($.now()) +
            " | iotJumpWay | STATUS | Published to: " +
            params.locationID +
            "/Devices/" +
            params.zoneID +
            "/" +
            params.deviceID +
            "/Command</p>"
        );
    }
};
$(document).ready(function() {
    iotJumpWayWebSoc.connect();
});