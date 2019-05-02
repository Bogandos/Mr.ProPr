
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.Text;
using System.Data.SqlClient;
using System.Data;

namespace WcfServiceLibrary1
{
    // ПРИМЕЧАНИЕ. Команду "Переименовать" в меню "Рефакторинг" можно использовать для одновременного изменения имени класса "Service1" в коде и файле конфигурации.
    public class Service1 : IService1
    {
        DataSet ds;
        SqlDataAdapter adapter;

        string constr = @"Data Source=DESKTOP-CRGN3IK\SQLEXPRESS;Initial Catalog=lab2_ProPr;Integrated Security=True";
       
        public DataSet SelectAllClients() // вывод всех клиентов
        {
            string procedureName = "SelectAllClients";

            using(SqlConnection con=new SqlConnection(constr))
            {
                con.Open();
                adapter = new SqlDataAdapter(procedureName, con);
                ds = new DataSet();
                adapter.Fill(ds, "Client");
                con.Close();
            }

            return ds;
        }
        
        public DataSet SelectClient(int id_client) // вывод одного клиента
        {
            string procedureName = "SelectClient";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@id_client", Value = id_client };
                command.Parameters.Add(parameter);

                SqlDataReader reader = command.ExecuteReader();
                DataTable table = new DataTable();

                ds = new DataSet();
                table.Columns.Add("id_client");
                table.Columns.Add("name");

                while (reader.Read())
                {
                    table.Rows.Add(reader.GetInt32(0), reader.GetString(1));
                }

                ds.Tables.Add(table);
                con.Close();

                return ds;
            }
        }
        
        public string InsertClient(string name) // добавление клиента
        {
            string procedureName = "InsertClient";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@name", Value = name };
                command.Parameters.Add(parameter);

                var result = command.ExecuteScalar();
                con.Close();

                return "Добавлен клиент ID=" + result;
            }
        }
        
        public string DeleteClient(int id_client) // удаление клиента
        {
            string procedureName = "DeleteClient";
            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@id_client", Value = id_client };
                command.Parameters.Add(parameter);

                var result = command.ExecuteScalar();
                con.Close();

                return "Информация о клиенте удалена";
            }
        }
        
        public string UpdateClient(int id_client, string name) // обновление данных о клиенте
        {
            string procedureName = "UpdateClient";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@id_client", Value = id_client };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@name", Value = name };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);

                var result = command.ExecuteScalar();
                con.Close();

                return "Данные клиента ID=" + id_client + " обновлены";
            }
        }

        public DataSet SelectAllRequests() // вывод всех заявок
        {
            string procedureName = "SelectAllRequests";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();
                adapter = new SqlDataAdapter(procedureName, con);
                ds = new DataSet();
                adapter.Fill(ds, "Request");
                con.Close();
            }

            return ds;
        }

        public DataSet SelectRequest(int id_request) // вывод одной заявки
        {
            string procedureName = "SelectRequest";
            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@id_request", Value = id_request };
                command.Parameters.Add(parameter1);

                SqlDataReader reader = command.ExecuteReader();
                DataTable table = new DataTable();

                ds = new DataSet();
                table.Columns.Add("id_request");
                table.Columns.Add("client_id");

                while (reader.Read())
                {
                    table.Rows.Add(reader.GetInt32(0), reader.GetString(1));
                }

                ds.Tables.Add(table);
                con.Close();

                return ds;
            }
        }

        public DataSet SelectRequestDetails(int request_id, int service_id) // вывод деталей одной заявки
        {
            string procedureName = "SelectRequestDetails";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@request_id", Value = request_id };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@service_id", Value = service_id };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);

                SqlDataReader reader = command.ExecuteReader();
                DataTable table = new DataTable();

                ds = new DataSet();
                table.Columns.Add("request_id");
                table.Columns.Add("service_id");
                table.Columns.Add("count");

                while (reader.Read())
                {
                    table.Rows.Add(reader.GetInt32(0), reader.GetString(1));
                }

                ds.Tables.Add(table);
                con.Close();

                return ds;
            }
        }

        public string InsertRequest(int client_id) // добавление заявки
        {
            string procedureName = "InsertRequest";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@client_id", Value = client_id };
                command.Parameters.Add(parameter);

                var result = command.ExecuteScalar();
                con.Close();

                return "Добавлена заявка ID=" + result;
            }
        }

        public string InsertRequestDetails(int request_id, int service_id, int count) // добавление деталей конкретной заявки
        {
            string procedureName = "InsertRequestDetails";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@request_id", Value = request_id };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@service_id", Value = service_id };
                SqlParameter parameter3 = new SqlParameter { ParameterName = "@count", Value = count };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);
                command.Parameters.Add(parameter3);

                var result = command.ExecuteScalar();
                con.Close();

                return "Детали заявки обновлены";
            }
        }

        public string DeleteRequest(int id_request) // удаление заявки
        {
            string procedureName = "DeleteRequest";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@id_request", Value = id_request };
                command.Parameters.Add(parameter);

                var result = command.ExecuteScalar();
                con.Close();

                return "Заявка удалена";
            }
        }

        public string DeleteRequestDetails(int request_id, int service_id) // удаление деталей о заявке
        {
            string procedureName = "DeleteRequestDetails";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@request_id", Value = request_id };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@service_id", Value = service_id };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);

                var result = command.ExecuteScalar();
                con.Close();
                return "Сведения о заявке удалены";
            }
        }

        public string UpdateRequest(int id_request, int client_id) // обновление данных о заявке
        {
            string procedureName = "UpdateRequest";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@id_request", Value = id_request };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@client_id", Value = client_id };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);

                var result = command.ExecuteScalar();
                con.Close();

                return "Заявка ID=" + id_request + " обновлена";
            }
        }

        public DataSet SelectAllServices() // вывод всех услуг
        {
            string procedureName = "SelectAllServices";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();
                adapter = new SqlDataAdapter(procedureName, con);
                ds = new DataSet();
                adapter.Fill(ds, "Service");
                con.Close();
            }

            return ds;
        }

        public DataSet SelectService(int id_service) // вывод одной услуги
        {
            string procedureName = "SelectService";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@id_service", Value = id_service };
                command.Parameters.Add(parameter);

                SqlDataReader reader = command.ExecuteReader();
                DataTable table = new DataTable();

                ds = new DataSet();
                table.Columns.Add("id_service");
                table.Columns.Add("name");
                table.Columns.Add("price");

                while (reader.Read())
                {
                    table.Rows.Add(reader.GetInt32(0), reader.GetString(1),reader.GetInt32(2));
                }

                ds.Tables.Add(table);
                con.Close();

                return ds;
            }
        }

        public string InsertService(string name, int price) // добавление услуги
        {
            string procedureName = "InsertService";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@name", Value = name };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@price", Value = price };

                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);

                var result = command.ExecuteScalar();
                con.Close();

                return "Добавлена услуга ID=" + result;
            }
        }

        public string DeleteService(int id_service) // удаление услуги
        {
            string procedureName = "DeleteService";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter = new SqlParameter { ParameterName = "@id_service", Value = id_service };
                command.Parameters.Add(parameter);

                var result = command.ExecuteScalar();
                con.Close();

                return "Услуга удалена";
            }
        }

        public string UpdateService(int id_service, string name, int price) // обновление информации об услуге
        {
            string procedureName = "UpdateService";

            using (SqlConnection con = new SqlConnection(constr))
            {
                con.Open();

                SqlCommand command = new SqlCommand(procedureName, con);
                command.CommandType = System.Data.CommandType.StoredProcedure;

                SqlParameter parameter1 = new SqlParameter { ParameterName = "@id_service", Value = id_service };
                SqlParameter parameter2 = new SqlParameter { ParameterName = "@name", Value = name };
                SqlParameter parameter3 = new SqlParameter { ParameterName = "@price", Value = price };
                command.Parameters.Add(parameter1);
                command.Parameters.Add(parameter2);
                command.Parameters.Add(parameter3);

                var result = command.ExecuteScalar();
                con.Close();

                return "Услуга ID=" + id_service + " обновлена";
            }
        }
    }
}
