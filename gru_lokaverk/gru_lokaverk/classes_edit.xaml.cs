using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for classes_edit.xaml
    /// </summary>
    public partial class classes_edit : Window
    {
        sql database = new sql();

        List<string> classEdit;
        List<string> RoomTypes;
        string[] RoomsDescription_Array = new string[2];
        string[] selectedValueArray;
        string SelectedValue, infoSentFrom;

        public classes_edit(String Selected, string infoSent)
        {
            database.ConnectToDatabase();
            InitializeComponent();
            SelectedValue = Selected;
            infoSentFrom = infoSent;
            addInfoToTextbox();
        }

        private void btn_Close_Click(object sender, RoutedEventArgs e)
        {
            this.Close();
        }

        public Button closeWindow
        {
            get { return this.btn_Close; }
        }
        public Button UpdateList
        {
            get { return this.btn_save; }
        }

        private void addInfoToTextbox()
        {
            if (infoSentFrom == "rooms")
            {
                classEdit = database.getRooms();
                comboBox_types.Visibility = Visibility.Visible;
                txtbox_Descr.Visibility = Visibility.Hidden;
            }
            else
            {
                classEdit = database.getAlldata("classes", "name");
                comboBox_types.Visibility = Visibility.Hidden;
                txtbox_Descr.Visibility = Visibility.Visible;
            }
            foreach (var item in classEdit)
            {
                selectedValueArray = new string[4];
                selectedValueArray = item.Split(';');
                if (SelectedValue == selectedValueArray[0])
                {
                    txtbox_Name.Text = selectedValueArray[1];
                    txtbox_Descr.Text = selectedValueArray[2];
                    //For the combobox in classes
                    if (infoSentFrom == "rooms") // There is not need for this IF sentence, but takes less RAM if classes is not running.
                    {
                        RoomTypes = new List<string>();
                        RoomTypes = database.getAlldata("types", "id");

                        char split = ';';
                        RoomsDescription_Array = null;
                        foreach (string type in RoomTypes)
                        {
                            RoomsDescription_Array = type.Split(split);

                            if (selectedValueArray[3] == RoomsDescription_Array[1])
                            {
                                comboBox_types.Items.Insert(0, RoomsDescription_Array[1]);
                                comboBox_types.SelectedIndex = 0;
                            }
                            else
                                comboBox_types.Items.Add(RoomsDescription_Array[1]);
                        }
                    }
                    return;
                }
            }
        }

        private void btn_save_Click(object sender, RoutedEventArgs e)
        {
            if (infoSentFrom == "classes")
            {
                if (txtbox_Name.Text != selectedValueArray[1])
                {
                    infoSentFrom = "classes_newName";
                    database.Update("classes", "id", "name", "description", txtbox_Name.Text, txtbox_Descr.Text, selectedValueArray[0], infoSentFrom);//OldNameArray[0] = the id
                }
                else
                {
                    infoSentFrom = "classes_SameName";
                    database.Update("classes", "id", "description", null, txtbox_Descr.Text, null, selectedValueArray[0], infoSentFrom);
                }
            }
            if (infoSentFrom == "rooms")
            {
                //To get the type ID from the Combobox
                string typeID = null;
                RoomsDescription_Array = null;
                foreach (string type in RoomTypes)
                {
                    RoomsDescription_Array = type.Split(';');
                    if (RoomsDescription_Array[1] == comboBox_types.SelectedValue.ToString())
                        typeID = RoomsDescription_Array[0];
                }
                if (txtbox_Name.Text != selectedValueArray[1])
                {
                    infoSentFrom = "rooms_newNumber";
                    database.Update("rooms", "id", "number", "type", txtbox_Name.Text, typeID, selectedValueArray[0], infoSentFrom);
                }
                else
                {
                    infoSentFrom = "rooms_SameNumber";
                    database.Update("rooms", "id", "type", null, typeID, null, selectedValueArray[0], infoSentFrom);
                }
             }
            this.Close();      
         }
        
    }
}