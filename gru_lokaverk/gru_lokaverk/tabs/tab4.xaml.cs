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
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Windows.Controls.Primitives;
using MySql.Data.MySqlClient;
using System.Web;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab4.xaml
    /// </summary>
    public partial class tab4 : UserControl
    {
        sql database = new sql(); //SQL Database
        Edit_Schedule editWindow;

        List<string> getRooms; //List for Classes
        List<string> ClassSchedule;
        string[] ClassScheduleArray;

        Button[] btn_grid;
        int counter = 0, periodID = 0, dayOfWeekID = 0;
        string selectedRoom = null;

        private void RefreshTab4()
        {
            //showClasses();
            this.rooms_weekPlan.Children.Clear();
            fillDataIntoGrid();
        }

        public tab4()
        {
            try
            {
                database.ConnectToDatabase();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
            InitializeComponent();
            showClasses();

            fillDataIntoGrid();
        }

        private void Show_PopupToolTip(object sender, MouseEventArgs e)
        {
            ListViewItem listViewItem = e.Source as ListViewItem;
            Classes Student = listViewItem.Content as Classes;
            PopupTextBlock.Text = Student.Marks;
            MyToolTip.PlacementTarget = listViewItem;
            MyToolTip.Placement = PlacementMode.MousePoint;
            MyToolTip.IsOpen = true;
        }
        private void Hide_PopupToolTip(object sender, MouseEventArgs e)
        {
            MyToolTip.IsOpen = false;
        }
        private void showClasses()
        {
            getRooms = new List<string>();
            List<Classes> lst = new List<Classes>();
            Classes sr = new Classes();
            try
            {
                getRooms = database.getRooms();
                string[] tempArray = new string[4];
                char split = ';';
                foreach (string item in getRooms)
                {
                    tempArray = item.Split(split);
                    sr.name = tempArray[1];
                    sr.Marks = tempArray[1] + " - " + tempArray[3];

                    if (selectedRoom == null)
                    {
                        selectedRoom = sr.name;
                        ClassesView.SelectedIndex = 0;
                    }
                    lst.Add(sr);
                    sr = new Classes();
                }
                MyPanel.DataContext = lst;
            }
            catch (Exception)
            {
                return;
            }
        }

        private void fillDataIntoGrid()
        {
            this.rooms_weekPlan.ColumnDefinitions.Clear();
            this.rooms_weekPlan.RowDefinitions.Clear();
            btn_grid = new Button[128];

            List<string> weekDays = new List<string>();
            List<string> time = new List<string>();

            string[] days = new string[8];
            try
            {
                weekDays = database.getAlldata("days","id");
                time = database.getAlldata("periods","id");
                ClassSchedule = database.getWeekPlan();

                counter = 0;
                string[] tempSplitArray = new string[2];
                foreach (string item in weekDays)//Gets the weekdays from the database and puts them into an array.
                {
                    tempSplitArray = item.Split(';');
                    days[counter] = tempSplitArray[1];
                    counter++;
                }
                counter = 0;
                for (int j = 0; j < 8; j++)
                {
                    periodID = 0;

                    this.rooms_weekPlan.ColumnDefinitions.Add(new ColumnDefinition());

                    for (int i=0; i < 16; i++)
                    {
                        string btn_content = null;

                        btn_grid[counter] = new Button();
                        btn_grid[counter].Height = 27.4;//27

                        this.rooms_weekPlan.RowDefinitions.Add(new RowDefinition() { Height = GridLength.Auto });

                        //Adds days to the week
                        if ((counter) % 16 == 0 && counter > 15)// (counter) % 15 == 0 && counter > 5
                        {
                            btn_content = days[j - 1];
                        }
                        //Adds the time to the schedule

                        if (counter > 0 && counter < 16)
                        {
                            string[] tempArray = new string[5];
                            char split = ';';
                            tempArray = time[(counter - 1)].Split(split);
                            btn_content = tempArray[1] + " - " + tempArray[2];
                        }
                        /* Timestamp
                         * 8:10 (ID - 1)
                         * 8:50 (ID - 2)
                         * 9:50 (ID - 3)
                         * 10:30 (ID - 4)
                         * 11:15 (ID - 5)
                         * 11:55 (ID - 6)
                         * 12:35 (ID - 7)
                         * 13:15 (ID - 8)
                         * 13:55 (ID - 9)
                         * 14:40 (ID - 10)
                         * 15:20 (ID - 11)
                         * 16:55 (ID - 12)
                         * 17:35 (ID - 13)
                         * 18:15 (ID - 14)
                         * 18:55 (ID - 15)
                         * */
                        
                        if (counter >16 && counter<32)//Monday, ID 1
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if(counter>32 && counter <48)//Tuesday, ID 2
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if (counter > 48 && counter < 64)//Wednsday, ID 3
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if (counter > 64 && counter < 80) //Thursday, ID 4
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if (counter > 80 && counter < 96) //Friday, ID 5
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if (counter > 96 && counter < 112)//Saturday, ID 6
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        else if (counter > 112 && counter < 128) //Sunday, ID 7
                        {
                            if (checkClass())
                                btn_content = ClassScheduleArray[2];
                        }
                        string dayID_periodID = dayOfWeekID + ";" + periodID;

                        btn_grid[counter].Tag = dayID_periodID;
                        btn_grid[counter].Content = btn_content;

                        Grid.SetRow(btn_grid[counter], i);
                        Grid.SetColumn(btn_grid[counter], j);
                        
                        this.btn_grid[counter].Click += new RoutedEventHandler(tab1_Click);
                        this.rooms_weekPlan.Children.Add(btn_grid[counter]);

                        counter++;
                        periodID++;
                    }

                    dayOfWeekID++;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }

        private bool checkClass()
        {
            ClassScheduleArray = new string[4];
            foreach (var item in ClassSchedule)
            {
                ClassScheduleArray = item.Split(';');
                if (ClassScheduleArray[0] == dayOfWeekID.ToString() && ClassScheduleArray[1] == periodID.ToString() && ClassScheduleArray[3] == selectedRoom)
                {
                    return true;
                }
            }
            return false;
        }

        private void refreshAll()
        {
            dayOfWeekID = 0;
            periodID = 0;
            RefreshTab4();
        }


        void tab1_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                string dayID_PeriodID = ((Button)sender).Tag.ToString();
                string[] tempArray = new string[2];
                tempArray = dayID_PeriodID.Split(';');
                if (tempArray[0] != "0" && tempArray[1] != "0")//So Edit window wont come up when days or time is clicked
                {
                    string btnContent = " -- Please Select -- ";
                    if (((Button)sender).Content != null)
                        btnContent = ((Button)sender).Content.ToString();
                    if (editWindow != null)
                        editWindow.Close();
                    editWindow = new Edit_Schedule(dayID_PeriodID, btnContent, selectedRoom);
                    editWindow.closeWindow.Click += new RoutedEventHandler(closeWindow_Click);
                    editWindow.UpdateList.Click += new RoutedEventHandler(UpdateList_Click);
                    editWindow.ClearVal.Click += new RoutedEventHandler(ClearVal_Click);
                    editWindow.Owner = Window.GetWindow(this);
                    editWindow.ShowDialog();
                }
            }
            catch (Exception)
            {
                RefreshTab4();
            }
        }

        void ClearVal_Click(object sender, RoutedEventArgs e)
        {
            refreshAll();
        }

        void UpdateList_Click(object sender, RoutedEventArgs e)
        {
            refreshAll();
        }

        void closeWindow_Click(object sender, RoutedEventArgs e)
        {
            if (editWindow != null)
                editWindow = null;
            refreshAll();
        }

        private void ClassesView_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            Classes valueSelected = (Classes)ClassesView.SelectedItems[0];
            selectedRoom = valueSelected.name;

            refreshAll();
        }

        private void btn_refresh_Click(object sender, RoutedEventArgs e)
        {
            refreshAll();
        }
    }
}
