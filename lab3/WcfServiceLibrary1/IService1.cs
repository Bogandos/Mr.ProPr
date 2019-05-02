using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.Text;
using System.Data;

namespace WcfServiceLibrary1
{
    [ServiceContract]
    public interface IService1
    {
        [OperationContract]
        DataSet SelectAllClients();      

        [OperationContract]
        DataSet SelectClient(int id_client);

        [OperationContract]
        string InsertClient(string name);

        [OperationContract]
        string DeleteClient(int id_client);

        [OperationContract]
        string UpdateClient(int id_client, string name);


        [OperationContract]
        DataSet SelectAllRequests();
        
        [OperationContract]
        DataSet SelectRequest(int id_request);

        [OperationContract]
        DataSet SelectRequestDetails(int request_id, int service_id);

        [OperationContract]
        string InsertRequest(int client_id);

        [OperationContract]
        string InsertRequestDetails(int request_id, int service_id, int count);

        [OperationContract]
        string DeleteRequest(int id_request);

        [OperationContract]
        string DeleteRequestDetails(int request_id, int service_id);

        [OperationContract]
        string UpdateRequest(int id_request, int client_id);


        [OperationContract]
        DataSet SelectAllServices();

        [OperationContract]
        DataSet SelectService(int id_service);

        [OperationContract]
        string InsertService(string name, int price);

        [OperationContract]
        string DeleteService(int id_service);

        [OperationContract]
        string UpdateService(int id_service, string name, int price);

        // TODO: Добавьте здесь операции служб
    }

    // Используйте контракт данных, как показано на следующем примере, чтобы добавить сложные типы к сервисным операциям.
    // В проект можно добавлять XSD-файлы. После построения проекта вы можете напрямую использовать в нем определенные типы данных с пространством имен "WcfServiceLibrary1.ContractType".
   
}
