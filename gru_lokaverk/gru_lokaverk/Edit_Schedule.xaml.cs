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
    /// Interaction logic for Edit_Schedule.xaml
    /// </summary>
    public partial class Edit_Schedule : Window
    {
        sql database = new sql();

        List<string> ClassSchedule; 
        List<string> allClasses;
        List<string> allRooms;
        List<string> day_Periods;
        string[] tempSplitArray, dayPeriod_ID;
        string ButtonContent, SelectedRoom, classID,roomID, daysID_periodsID;
        string day_periodID;

        public Edit_Schedule(string boxSelected, string btnContent, string roomSelected)
        {
            database.ConnectToDatabase();

            InitializeComponent();
            daysID_periodsID = boxSelected;
            ButtonContent = (btnContent);
            SelectedRoom = roomSelected;
            FillComboBox();
            comboBox_classes.Focus();
        }

        private void btn_Close_Click(object sender, RoutedEventArgs e)
        {
            this.Close();
        }
        private void btn_save_Click(object sender, RoutedEventArgs e)
        {
            getClassRoomIDs();
            day_periodID = getDayPeriodID();

            try
            {
                if (validClass())
                {
                    if (ButtonContent == " -- Please Select -- ")
                        database.InsertInto3Columns("timetable", "class_id", "room_id", "day_period_id", classID, roomID, day_periodID);
                    else if (ButtonContent != " -- Please Select -- ")
                        database.Update("timetable", "class_id", "day_period_id", "room_id", day_periodID, roomID, classID, "sentfromEditWeek");
                    this.Close();
                }
            }
            catch (Exception)
            {
                return;
            }
        }
        public Button closeWindow
        {
            get { return this.btn_Close; }
        }
        public Button UpdateList
        {
            get { return this.btn_save; }
        }
        public Button ClearVal
        {
            get { return this.btn_clearValue; }
        }

        private void FillComboBox()
        {
             tempSplitArray = new string[4];
            allClasses = database.getAlldata("classes","name");

            foreach (var item in allClasses)
            {
                tempSplitArray = item.Split(';');


                if (tempSplitArray[1]==ButtonContent)
                {
                    comboBox_classes.Items.Insert(0, ButtonContent);
                    comboBox_classes.SelectedIndex = 0;
                }
                else
                    comboBox_classes.Items.Add(tempSplitArray[1]);
            }
            if (comboBox_classes.SelectedIndex!=0)
            {
                    comboBox_classes.Items.Insert(0, ButtonContent);
                    comboBox_classes.SelectedIndex = 0;
            }
            
        }

        private bool validClass()
        {
            tempSplitArray = new string[4];
            foreach (var item in allClasses)
            {
                tempSplitArray = item.Split(';');
                if (tempSplitArray[1] == comboBox_classes.SelectedValue.ToString())
                    return true;
            }
            return false;
        }

        //Gets the class and room ID
        private void getClassRoomIDs()
        {
            try
            {
                ClassSchedule = database.getWeekPlan();

                string[] tempSplitArray = new string[6];
                foreach (var item in ClassSchedule)
                {
                    tempSplitArray = item.Split(';');
                    if (tempSplitArray[2] == comboBox_classes.SelectedValue.ToString())
                        classID = tempSplitArray[4];
                }
                allRooms = database.getAlldata("rooms", "id");
                foreach (var item in allRooms)
                {
                    tempSplitArray = item.Split(';');
                    if (tempSplitArray[1] == SelectedRoom)
                        roomID = tempSplitArray[0];
                }
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }

        }
        //Gets the day_period ID
        private string getDayPeriodID()
        {
            //Here is the string that was sent from previous window splitted into 2 arrays.
            string[] dayAndPeriodID = new string[2];
            dayAndPeriodID = daysID_periodsID.Split(';');

            // here we find the id of the day_period by checking if day_id and period_id matches.
            string id = null;
            day_Periods = database.getAlldata("days_periods","id");
            dayPeriod_ID = new string[3];
            foreach (var item in day_Periods)
            {
                dayPeriod_ID = item.Split(';');
                if (dayPeriod_ID[1]== dayAndPeriodID[0] && dayPeriod_ID[2] == dayAndPeriodID[1])
                {
                    id = dayPeriod_ID[0];
                }
            }
            return id;
        }

        private void edit_Window_Loaded(object sender, RoutedEventArgs e)
        {
            Keyboard.Focus(this.comboBox_classes);
        }

        private void btn_clearValue_Click(object sender, RoutedEventArgs e)
        {
            try//DELETE FROM {0} WHERE {1} ='{2}'"
            {
                getClassRoomIDs();
                day_periodID = getDayPeriodID();

                database.deleteData("timetable", "day_period_id = " + day_periodID + " AND room_id", roomID);
                this.Close();
            }
            catch (Exception)
            {
                return;
            }
        }
    }
}
