<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Demo - MetaMask</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="src/web3.js"></script>
	<script>
		const contract_address = "0xb57fea534618f9580529e117da90166e9783b858";
		const abi = [{"anonymous": false,"inputs": [{"indexed": true,"name": "previousOwner","type": "address"}],"name": "OwnershipRenounced","type": "event"},{"anonymous": false,"inputs": [ {"indexed": true,"name": "previousOwner","type": "address"},{"indexed": true,"name": "newOwner","type": "address" }],"name": "OwnershipTransferred","type": "event"},{"constant": false, "inputs": [], "name": "renounceOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_maxLength", "type": "uint256" } ], "name": "setMaxLength", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_message", "type": "string" } ], "name": "setMessage", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_newOwner", "type": "address" } ], "name": "transferOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "payable": false, "stateMutability": "nonpayable", "type": "constructor" }, { "constant": true, "inputs": [], "name": "maxLength", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "message", "outputs": [ { "name": "", "type": "string" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "owner", "outputs": [ { "name": "", "type": "address" } ], "payable": false, "stateMutability": "view", "type": "function" } ];
		var network = "";
		var userAccount = "";
	</script>
	<script src="js/metamask.js"></script>
   <script>
      function setMessage() {
         let contract = new web3.eth.Contract(abi, contract_address);
         let message = $('#new_message').val();

         contract.methods.setMessage(message).send({ from: userAccount })
            .on('error', (error) => {
               console.log(error);
            })
            .on('transactionHash', (transactionHash) => {
               console.log("txhash: " + transactionHash);
               $('#txhash').text('transactionHash: ' + transactionHash);
            })
            .on('confirmation', (confirmationNumber, receipt) => {
               console.log('confirmationNumber', confirmationNumber)
               console.log(receipt);
               //$("#status_value").text('receipt: ' + receipt).css("color", "green");
               $("#status_value").text('Confirmed: ' + confirmationNumber).css("color", "green");
            })
      }
   </script>

<script>
const messageHash = web3.sha3('Apples');
const signature = await web3.eth.personal.sign(messageHash, web3.eth.defaultAccount);
</script>

</head>

<body>
   <p id="eth_network"></p>
   <p id="userAccount"></p>
   <div id="message"></div>
   <br />

   New Message: <input type="text" id="new_message" />
   <button onclick="javascript:setMessage()">Set Message</button>

   <p id="txhash"></p>
   <p id="status_value"></p>
</body>

</html>