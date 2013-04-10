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
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab1.xaml
    /// </summary>
    public partial class tab1 : UserControl
    {
        sql database = new sql();

        public tab1()
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
            fillDataIntoGrid();
        }

        private void fillDataIntoGrid()
        {
            this.WeekPlan.ColumnDefinitions.Clear();
            this.WeekPlan.RowDefinitions.Clear();

            List<string> weekDays = new List<string>();
            string[] days = new string[8];
            try
            {
                weekDays = database.getDays();
                int k = 0;
                foreach (string item in weekDays)//Gets the weekdays from the database and puts them into an array.
                {
                    days[k] = item;
                    k++;
                }

                for (int j = 0; j < 8; j++)//Sets Columns
                {
                    this.WeekPlan.ColumnDefinitions.Add(new ColumnDefinition());



                    for (int i = 0; i < 15; i++)//Sets rows
                    {
                        this.WeekPlan.RowDefinitions.Add(new RowDefinition() { Height = GridLength.Auto });
                        Label week = new Label(); week.Content = days[j];//Weekdays

                        Label time = new Label(); time.Content = "tími";

                        Grid.SetRow(time,i+1);
                        Grid.SetColumn(time,j);

                        Grid.SetRow(week, 0);
                        Grid.SetColumn(week, j+1);


                        this.WeekPlan.Children.Add(week);
                        this.WeekPlan.Children.Add(time);
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }
    }
}
