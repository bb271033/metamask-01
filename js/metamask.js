//let contract;
		window.addEventListener('load', function () {
			// Modern dapp browser...
			if (window.ethereum) {
				web3 = new Web3(ethereum);
				try {
					ethereum.enable().then(result => {
						startApp();
					});
				}
				catch (err) {
					console.log(err);
				}
			}
			else if (typeof web3 !== 'undefined') {
				web3 = new Web3(web3.currentProvider);
				startApp();
			}
			else {
				web3 = new Web3(new Web3.providers.HttpProvider("https://ropsten.infura.io/"));
				startApp();
			}
		});
		
		function startApp() {
			web3.eth.net.getId().then(netId => {
				console.log('netId: ' + netId);
				switch (netId) {
					case 1:
						network = 'Mainnet';
						break
					case 3:
						network = 'Ropsten';
						break
					case 4:
						network = 'Rinkeby';
						break
					case 42:
						network = 'Kovan';
						break
					default:
						network = 'Unknown';
            }
            $("#eth_network").text("Network: " + network);

            web3.eth.getAccounts().then(accounts => {
               userAccount = accounts[0];
               $('#userAccount').text("Account: " + userAccount);

               reloadInfo();
            })
         })
      }

      function reloadInfo() {
         let contract = new web3.eth.Contract(abi, contract_address);
         //console.log('contract', contract);

         contract.methods.message().call((error, result) => {
            if (error) {
               return console.log(error);
            }
            $('#message').text(result);
         });
      }